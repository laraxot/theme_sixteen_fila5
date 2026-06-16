<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
use Themes\Sixteen\Support\BlockCategoryRegistry;

$blocksRoot = dirname(__DIR__, 2).'/resources/views/components/blocks';

test('blocks subfolders use allowed tailwind or flowbite names', function () use ($blocksRoot): void {
    $invalid = BlockCategoryRegistry::invalidFoldersIn($blocksRoot);

    Assert::assertSame(
        [],
        $invalid,
        'Sottocartelle blocks/ non ammesse (usare slug da Flowbite/Tailwind UI): '.implode(', ', $invalid)
    );
});

test('registry marks known domain folders as legacy', function (): void {
    Assert::assertTrue(BlockCategoryRegistry::isLegacy('ticket-layout'));
    Assert::assertTrue(BlockCategoryRegistry::isLegacy('ticket-list'));
    Assert::assertTrue(BlockCategoryRegistry::isCanonical('hero'));
    Assert::assertTrue(BlockCategoryRegistry::isCanonical('cta'));
    Assert::assertFalse(BlockCategoryRegistry::isCanonical('ticket-layout'));
});

test('legacy folders do not overlap canonical list', function (): void {
    $overlap = array_values(array_intersect(
        BlockCategoryRegistry::canonicalFolders(),
        BlockCategoryRegistry::LEGACY_FOLDERS
    ));

    Assert::assertSame([], $overlap);
});
