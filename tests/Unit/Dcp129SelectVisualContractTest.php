<?php

declare(strict_types=1);

it('keeps the data-step select native and aligned with the Design Comuni reference', function (): void {
    $css = file_get_contents(dirname(__DIR__, 2).'/resources/css/app/12-wizard-dc-form-shell.css');

    expect($css)->toContain(
        '.cmp-wizard-widget .wizard-dc-form-shell .it-page-section#report-info .select-wrapper.select-partials select.u-grey-dark',
    );
    expect($css)->toMatch('/appearance:\s*auto\s*!important/');
    expect($css)->toMatch('/background-image:\s*none\s*!important/');
    expect($css)->toMatch('/padding:\s*6px\s+8px\s*!important/');
});
