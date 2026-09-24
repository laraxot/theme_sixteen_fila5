#!/usr/bin/env python3
"""
Visual Comparison Script - Analizza differenze tra reference e local
"""

import re
import json
import os
from collections import defaultdict

def extract_sections(html: str) -> dict:
    """Estrae le sezioni principali della pagina"""
    sections = {}
    
    # Hero section
    hero_match = re.search(r'<div[^>]*class="[^"]*it-hero[^"]*"[^>]*>(.*?)</div>\s*</section>', html, re.DOTALL)
    if hero_match:
        sections['hero'] = hero_match.group(0)
    
    # Cards/Categories
    cards = re.findall(r'<div[^>]*class="[^"]*card[^"]*"[^>]*>.*?</div>\s*</div>', html, re.DOTALL)
    sections['cards'] = cards
    
    # Footer
    footer_match = re.search(r'<footer[^>]*>(.*?)</footer>', html, re.DOTALL)
    if footer_match:
        sections['footer'] = footer_match.group(0)
    
    return sections

def extract_classes(html: str) -> dict:
    """Estrae tutte le classi CSS dalla pagina"""
    class_pattern = re.findall(r'class="([^"]*)"', html)
    classes = defaultdict(int)
    
    for cls_group in class_pattern:
        for cls in cls_group.split():
            if cls.strip():
                classes[cls] += 1
    
    return dict(sorted(classes.items(), key=lambda x: -x[1]))

def extract_ids(html: str) -> dict:
    """Estrae tutti gli ID dalla pagina"""
    id_pattern = re.findall(r'id="([^"]*)"', html)
    ids = defaultdict(int)
    
    for id_name in id_pattern:
        if id_name.strip():
            ids[id_name] += 1
    
    return dict(sorted(ids.items(), key=lambda x: -x[1]))

def compare_classes(ref_classes: dict, local_classes: dict) -> dict:
    """Confronta le classi tra reference e local"""
    ref_set = set(ref_classes.keys())
    local_set = set(local_classes.keys())
    
    return {
        'missing_in_local': list(ref_set - local_set)[:30],
        'extra_in_local': list(local_set - ref_set)[:30],
        'common': list(ref_set & local_set)[:30]
    }

def main():
    temp_dir = "/var/www/_bases/base_fixcity_fila5/laravel/Themes/Sixteen/docs/visual-parity/temp"
    
    # Carica i file HTML
    with open(f"{temp_dir}/reference-lista-categorie.html", 'r', encoding='utf-8') as f:
        ref_html = f.read()
    
    with open(f"{temp_dir}/local-lista-categorie.html", 'r', encoding='utf-8') as f:
        local_html = f.read()
    
    # Estrai classi
    ref_classes = extract_classes(ref_html)
    local_classes = extract_classes(local_html)
    
    # Estrai IDs
    ref_ids = extract_ids(ref_html)
    local_ids = extract_ids(local_html)
    
    # Confronta
    class_diff = compare_classes(ref_classes, local_classes)
    
    print("=" * 60)
    print("ANALISI COMPARATIVA: lista-categorie")
    print("=" * 60)
    
    print("\n=== CLASSI MANCANTI IN LOCAL (presenti in reference) ===")
    for cls in class_diff['missing_in_local'][:20]:
        print(f"  - {cls}")
    
    print("\n=== CLASSI EXTRA IN LOCAL (non presenti in reference) ===")
    for cls in class_diff['extra_in_local'][:20]:
        print(f"  + {cls}")
    
    print("\n=== ID PRESENTI IN ENTRAMBI ===")
    common_ids = set(ref_ids.keys()) & set(local_ids.keys())
    print(f"  {len(common_ids)} IDs in comune")
    
    print("\n=== ID PRESENTI SOLO IN REFERENCE ===")
    for id_name in list(set(ref_ids.keys()) - set(local_ids.keys()))[:10]:
        print(f"  - {id_name}")
    
    print("\n=== ID PRESENTI SOLO IN LOCAL ===")
    for id_name in list(set(local_ids.keys()) - set(ref_ids.keys()))[:10]:
        print(f"  + {id_name}")
    
    # Salva il report
    report = {
        'page': 'lista-categorie',
        'timestamp': '2026-04-04',
        'class_differences': class_diff,
        'reference_ids': list(ref_ids.keys()),
        'local_ids': list(local_ids.keys())
    }
    
    output_file = f"{temp_dir}/comparison-report.json"
    with open(output_file, 'w', encoding='utf-8') as f:
        json.dump(report, f, indent=2, ensure_ascii=False)
    
    print(f"\n[Report salvato in: {output_file}]")

if __name__ == '__main__':
    main()