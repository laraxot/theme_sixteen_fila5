<?php

declare(strict_types=1);

use Dom\HTMLDocument;
use Modules\Fixcity\Database\Factories\TicketFactory;
use Modules\Fixcity\Enums\TicketStatusEnum;
use Modules\Fixcity\Enums\TicketTypeEnum;
use Modules\Fixcity\Tests\TestCase;
use PHPUnit\Framework\Assert;

use function Pest\Laravel\get;

uses(TestCase::class);

/**
 * DCP-288 (FO-1-01): la modale "Cerca" dell'intestazione non cercava. Il campo si chiamava `autocomplete-two`, l'elenco legge `q`;
 * il form non aveva `action` (dalla home restava sulla home) e il pulsante "Cerca" era `type="button"`.
 *
 * @return array{action: string, method: string, role: string, input: ?string, hasSubmit: bool, placeholder: string, label: string}
 */
function searchModalForm(string $locale): array
{
    $html = get('/'.$locale)->assertOk()->getContent();
    Assert::assertIsString($html);
    $form = HTMLDocument::createFromString($html, LIBXML_NOERROR)->querySelector('#search-modal form');
    Assert::assertNotNull($form, 'la modale di ricerca ha un form ('.$locale.')');
    $input = $form->querySelector('input[type="search"]');
    Assert::assertNotNull($input, 'il form ha il campo di ricerca ('.$locale.')');

    return [
        'action' => (string) $form->getAttribute('action'),
        'method' => strtolower((string) $form->getAttribute('method')),
        'role' => (string) $form->getAttribute('role'),
        'input' => $input->getAttribute('name'),
        'hasSubmit' => $form->querySelector('button[type="submit"]') !== null,
        'placeholder' => (string) $input->getAttribute('placeholder'),
        'label' => trim((string) $form->querySelector('label[for="'.$input->getAttribute('id').'"]')?->textContent),
    ];
}

it('submits the query as q with a GET to the localized report list', function (string $locale): void {
    $form = searchModalForm($locale);

    expect($form['method'])->toBe('get')
        ->and($form['role'])->toBe('search')
        ->and($form['input'])->toBe('q')
        ->and($form['hasSubmit'])->toBeTrue()
        ->and($form['action'])->toEndWith('/'.$locale.'/tickets');
})->with(['it', 'en', 'de', 'es']);

it('filters the public list with what the modal form sends', function (): void {
    TicketFactory::new()->createOne(['name' => 'Buca in via Solferino', 'status' => TicketStatusEnum::IN_PROGRESS, 'type' => TicketTypeEnum::ROAD_MAINTENANCE, 'location' => ['lat' => 43.7696, 'lng' => 11.2558, 'address' => 'Via Solferino - 50100 Firenze']]);
    TicketFactory::new()->createOne(['name' => 'Cestino rotto', 'status' => TicketStatusEnum::IN_PROGRESS, 'type' => TicketTypeEnum::ROAD_MAINTENANCE, 'location' => ['lat' => 43.7696, 'lng' => 11.2558, 'address' => 'Via Dalmazia - 50100 Firenze']]);

    $form = searchModalForm('it');
    $url = $form['action'].'?'.http_build_query([$form['input'] => 'cestino']);

    get($url)->assertOk()->assertSee('Cestino rotto')->assertDontSee('Buca in via Solferino')->assertSee('1 Risultato');
});

it('does not promise a whole-site search while it only searches reports', function (string $locale, string $wholeSiteWording): void {
    $form = searchModalForm($locale);

    expect($form['placeholder'])->not->toContain($wholeSiteWording)->not->toBe('')
        ->and($form['label'])->not->toContain($wholeSiteWording)->not->toBe('');
})->with([
    'it' => ['it', 'nel sito'],
    'en' => ['en', 'the site'],
    'de' => ['de', 'Website'],
    'es' => ['es', 'en el sitio'],
]);
