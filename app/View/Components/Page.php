<?php

declare(strict_types=1);

namespace Themes\Sixteen\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Page extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $side = 'content',
        public string $slug = '',
        public array $data = []
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        // Use pub_theme namespace (standard for themes, not sixteen)
        // This allows theme switching while maintaining compatibility
        return view('pub_theme::components.page', [
            'side' => $this->side,
            'slug' => $this->slug,
            'data' => $this->data,
        ]);
    }
}