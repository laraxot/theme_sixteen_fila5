#!/usr/bin/env python3
"""Diagnostica mappa admin ticket create senza credenziali hardcoded."""

from __future__ import annotations

import json
import os
from pathlib import Path

from playwright.sync_api import sync_playwright, TimeoutError as PlaywrightTimeoutError


TARGET_URL = "http://127.0.0.1:8000/fixcity/admin/tickets/create?step=form.data%3A%3Adata%3A%3Awizard-step"
SCREENSHOT_PATH = "scripts/fixcity-admin-ticket-create-map-python.png"


def _load_dotenv(dotenv_path: Path) -> None:
    if not dotenv_path.exists():
        return
    for raw_line in dotenv_path.read_text(encoding="utf-8").splitlines():
        line = raw_line.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        key, value = line.split("=", 1)
        key = key.strip()
        value = value.strip().strip("'").strip('"')
        os.environ.setdefault(key, value)


def _get_admin_credentials() -> tuple[str, str]:
    env_path = (Path(__file__).resolve().parents[3] / ".env").resolve()
    _load_dotenv(env_path)

    email = (
        os.getenv("FIXCITY_ADMIN_EMAIL")
        or os.getenv("ADMIN_EMAIL")
        or os.getenv("FILAMENT_ADMIN_EMAIL")
        or ""
    )
    password = (
        os.getenv("FIXCITY_ADMIN_PASSWORD")
        or os.getenv("ADMIN_PASSWORD")
        or os.getenv("FILAMENT_ADMIN_PASSWORD")
        or ""
    )
    if not email or not password:
        raise RuntimeError(
            f"Credenziali admin mancanti in {env_path}. "
            "Imposta FIXCITY_ADMIN_EMAIL e FIXCITY_ADMIN_PASSWORD."
        )
    return email, password


def main() -> int:
    email, password = _get_admin_credentials()

    with sync_playwright() as playwright:
        browser = playwright.chromium.launch(headless=True)
        page = browser.new_page(viewport={"width": 1440, "height": 1200})

        js_errors: list[str] = []
        failed_requests: list[dict[str, str]] = []

        page.on("pageerror", lambda err: js_errors.append(str(err)))
        page.on(
            "requestfailed",
            lambda req: failed_requests.append(
                {
                    "url": req.url,
                    "method": req.method,
                    "failure": (req.failure.error_text if req.failure else "unknown"),
                }
            ),
        )

        page.goto(TARGET_URL, wait_until="domcontentloaded", timeout=60000)

        if "/login" in page.url or "/auth/login" in page.url:
            page.locator('input[type="email"], input[name="email"], input[name="data.email"]').first.fill(email)
            page.locator('input[type="password"], input[name="password"], input[name="data.password"]').first.fill(password)
            page.locator('button[type="submit"], button:has-text("Accedi"), button:has-text("Login")').first.click()
            page.wait_for_timeout(1500)
            page.goto(TARGET_URL, wait_until="domcontentloaded", timeout=60000)

        try:
            page.wait_for_selector("coordinate-picker-lit", timeout=30000)
        except PlaywrightTimeoutError as exc:
            browser.close()
            raise RuntimeError("coordinate-picker-lit non trovato nella pagina target") from exc

        page.wait_for_timeout(1500)

        snapshot = page.evaluate(
            """() => {
                const host = document.querySelector('coordinate-picker-lit');
                const leaflet = host?.querySelector('.leaflet-container') ?? null;
                const controls = host?.querySelectorAll('.ctrl-btn') ?? [];
                return {
                    url: window.location.href,
                    hostExists: Boolean(host),
                    leafletExists: Boolean(leaflet),
                    controlsCount: controls.length,
                    tileCount: host ? host.querySelectorAll('.leaflet-tile').length : 0,
                };
            }"""
        )

        page.screenshot(path=SCREENSHOT_PATH, full_page=True)
        browser.close()

    print(
        json.dumps(
            {
                "targetUrl": TARGET_URL,
                "screenshot": SCREENSHOT_PATH,
                "jsErrors": js_errors,
                "failedRequests": failed_requests,
                "snapshot": snapshot,
            },
            indent=2,
        )
    )
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
