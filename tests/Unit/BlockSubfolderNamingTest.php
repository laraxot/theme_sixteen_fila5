<?php

declare(strict_types=1);

namespace Themes\Sixteen\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Themes\Sixteen\Support\BlockCategoryRegistry;

class BlockSubfolderNamingTest extends TestCase
{
    private string $blocksRoot;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blocksRoot = dirname(__DIR__, 2).'/resources/views/components/blocks';
    }

    public function test_blocks_subfolders_use_allowed_tailwind_or_flowbite_names(): void
    {
        $invalid = BlockCategoryRegistry::invalidFoldersIn($this->blocksRoot);

        $this->assertSame(
            [],
            $invalid,
            'Sottocartelle blocks/ non ammesse (usare slug da Flowbite/Tailwind UI): '.implode(', ', $invalid)
        );
    }

    public function test_registry_marks_known_domain_folders_as_legacy(): void
    {
        $this->assertTrue(BlockCategoryRegistry::isLegacy('ticket-layout'));
        $this->assertTrue(BlockCategoryRegistry::isLegacy('ticket-list'));
        $this->assertTrue(BlockCategoryRegistry::isCanonical('hero'));
        $this->assertTrue(BlockCategoryRegistry::isCanonical('cta'));
        $this->assertFalse(BlockCategoryRegistry::isCanonical('ticket-layout'));
    }

    public function test_legacy_folders_do_not_overlap_canonical_list(): void
    {
        $overlap = array_values(array_intersect(
            BlockCategoryRegistry::canonicalFolders(),
            BlockCategoryRegistry::LEGACY_FOLDERS
        ));

        $this->assertSame([], $overlap);
    }
}
