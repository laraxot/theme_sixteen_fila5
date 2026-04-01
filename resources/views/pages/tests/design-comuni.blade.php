<?php

declare(strict_types=1);

use function Livewire\Volt\layout;

layout('pub_theme::layouts.design-comuni');

?>

<x-page side="content" :slug="$pageSlug" :data="$data" />