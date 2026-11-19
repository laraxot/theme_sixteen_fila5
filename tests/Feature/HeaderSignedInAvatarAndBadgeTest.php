<?php

declare(strict_types=1);

use Modules\Fixcity\Enums\TicketStatusEnum;
use Modules\Fixcity\Models\User;
use Modules\Fixcity\Notifications\TicketStatusChangedNotification;
use Tests\TestCase;
use Webmozart\Assert\Assert;

uses(TestCase::class);

/*
 * CMT-022: l'header del cittadino loggato mostra il suo avatar (le iniziali se non ha una foto: in Fixcity
 * comments.gravatar.enabled = false, nessuna richiesta a gravatar.com, issue #106) e il numero di notifiche
 * di stato non lette accanto alla voce "Notifiche". La notifica e' scritta dal canale database reale della TicketStatusChangedNotification.
 */
it('shows the signed-in citizen avatar and the unread notifications badge in the header', function (): void {
    $citizen = User::factory()->createOne(['email' => fake()->unique()->safeEmail(), 'name' => 'Giulia Verdi']);
    Assert::isInstanceOf($citizen, User::class);
    $citizen->notifyNow(new TicketStatusChangedNotification('TCK-HEADER-BADGE', TicketStatusEnum::IN_PROGRESS), ['database']);

    $this->actingAs($citizen)
        ->get('/it')
        ->assertOk()
        ->assertDontSee('gravatar.com', false)
        ->assertSee('user-initial-fallback', false)
        ->assertSee('data-element="unread-notifications"', false);
});
