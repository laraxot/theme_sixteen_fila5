<?php

declare(strict_types=1);

use PHPUnit\Framework\Assert;
<<<<<<< HEAD
use Themes\Sixteen\Actions\Block\IsCanonicalBlockCategoryFolderAction;
use Themes\Sixteen\Actions\Block\IsLegacyBlockCategoryFolderAction;
use Themes\Sixteen\Actions\Block\ListInvalidBlockCategoryFoldersAction;
use Themes\Sixteen\Datas\BlockCategoryRegistryData;
=======
use Themes\Sixteen\Support\BlockCategoryRegistry;
>>>>>>> 464cfc5 (.)

$blocksRoot = dirname(__DIR__, 2).'/resources/views/components/blocks';

test('blocks subfolders use allowed tailwind or flowbite names', function () use ($blocksRoot): void {
<<<<<<< HEAD
    $invalid = app(ListInvalidBlockCategoryFoldersAction::class)->execute($blocksRoot);
=======
    $invalid = BlockCategoryRegistry::invalidFoldersIn($blocksRoot);
>>>>>>> 464cfc5 (.)

    Assert::assertSame(
        [],
        $invalid,
        'Sottocartelle blocks/ non ammesse (usare slug da Flowbite/Tailwind UI): '.implode(', ', $invalid)
    );
});

test('registry marks known domain folders as legacy', function (): void {
<<<<<<< HEAD
    Assert::assertTrue(app(IsLegacyBlockCategoryFolderAction::class)->execute('ticket-layout'));
    Assert::assertTrue(app(IsLegacyBlockCategoryFolderAction::class)->execute('ticket-list'));
    Assert::assertTrue(app(IsCanonicalBlockCategoryFolderAction::class)->execute('hero'));
    Assert::assertTrue(app(IsCanonicalBlockCategoryFolderAction::class)->execute('cta'));
    Assert::assertFalse(app(IsCanonicalBlockCategoryFolderAction::class)->execute('ticket-layout'));
=======
    Assert::assertTrue(BlockCategoryRegistry::isLegacy('ticket-layout'));
    Assert::assertTrue(BlockCategoryRegistry::isLegacy('ticket-list'));
    Assert::assertTrue(BlockCategoryRegistry::isCanonical('hero'));
    Assert::assertTrue(BlockCategoryRegistry::isCanonical('cta'));
    Assert::assertFalse(BlockCategoryRegistry::isCanonical('ticket-layout'));
>>>>>>> 464cfc5 (.)
});

test('legacy folders do not overlap canonical list', function (): void {
    $overlap = array_values(array_intersect(
<<<<<<< HEAD
        BlockCategoryRegistryData::CANONICAL_FOLDERS,
        BlockCategoryRegistryData::LEGACY_FOLDERS
=======
        BlockCategoryRegistry::canonicalFolders(),
        BlockCategoryRegistry::LEGACY_FOLDERS
>>>>>>> 464cfc5 (.)
    ));

    Assert::assertSame([], $overlap);
});
