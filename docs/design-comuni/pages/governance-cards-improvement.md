# 🎯 Governance Cards + Events Calendar - CSS Improvement Plan

**File**: `laravel/Themes/Sixteen/resources/views/components/blocks/governance/cards.blade.php`

## 🔴 PROBLEMI ATTUALI

### 1. **Dipendenze Bootstrap Italia**
Classi Bootstrap Italia trovate:
- `.section-muted` - Background color
- `.card-wrapper` - Card layout
- `.card-overlapping` - Overlapping card effect
- `.card-teaser-wrapper-equal` - Grid layout
- `.card-teaser-block-3` - 3-column grid
- `.card-teaser` - Card style
- `.card-teaser-image` - Image variant
- `.card-flex` - Flex layout
- `.card-image-wrapper` - Image wrapper
- `.category-top` - Category label
- `.title-xsmall-semi-bold` - Typography
- `.card-title` - Title style
- `.text-paragraph-*` - Typography
- `.read-more` - Link style
- `.u-grey-light` - Color utility
- `.it-carousel-wrapper` - Carousel layout
- `.it-carousel-landscape-abstract-four-cols` - Carousel variant
- `.splide` - Carousel library
- `.card-bg` - Background color

### 2. **Responsive Issues**
- Grid non responsive (sempre 3 col su desktop)
- Carousel non adattabile su mobile

### 3. **Typography Issues**
- Classi custom `.title-xsmall-semi-bold`, `.text-paragraph-*` non Tailwind
- Tagli font non standard

### 4. **Interactive Issues**
- `.read-more` link non ben stilizzato
- Hover effects mancanti
- Carousel buttons non Tailwind-styled

### 5. **Spacing**
- `.pb-90`, `.pb-lg-50` - Non Tailwind
- `.px-lg-5` - Responsivo non standard
- `.mb-2`, `.mb-0` - Missinato Tailwind

## ✅ SOLUZIONE: Tailwind CSS Conversion

### Cards Section (Organi di governo)

**HTML Structure:**
```html
<section id="calendario" class="py-16 lg:py-20 px-4 lg:px-8 bg-slate-50">
  <div class="max-w-6xl mx-auto">
    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
      <!-- Card 1: Image + Title -->
      <a href="#" class="group block bg-white border border-slate-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
        <div class="relative aspect-square lg:aspect-[4/5] overflow-hidden bg-gray-100">
          <img src="..." alt="..." class="w-full h-full object-cover">
        </div>
        <div class="p-4 lg:p-6">
          <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Organi di governo</div>
          <h3 class="text-lg font-semibold text-slate-900 mb-2">Mario Rossi</h3>
          <p class="text-sm text-slate-600 mb-4">Il Sindaco della città</p>
          <div class="flex items-center text-blue-600 font-medium text-sm group-hover:text-blue-800">
            <span>Vai alla pagina</span>
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">...</svg>
          </div>
        </div>
      </a>

      <!-- Card 2-3: Text-only -->
      <a href="#" class="group block bg-white border border-slate-200 rounded-lg p-4 lg:p-6 hover:shadow-md transition-shadow">
        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-2">Organi di governo</div>
        <h3 class="text-lg font-semibold text-slate-900 mb-3">La giunta comunale</h3>
        <p class="text-sm text-slate-600 mb-4">La giunta, nominata dal sindaco...</p>
        <div class="flex items-center text-blue-600 font-medium text-sm group-hover:text-blue-800">
          <span>Vai alla pagina</span>
          <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">...</svg>
        </div>
      </a>
    </div>
  </div>
</section>
```

### Events Section

**HTML Structure:**
```html
<section id="events" class="py-16 lg:py-20 px-4 lg:px-8 bg-white">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-slate-900 mb-8">Eventi</h2>
    
    <!-- Month Carousel -->
    <div class="bg-white rounded-lg border border-slate-200">
      <div class="px-6 py-4 border-b border-slate-200">
        <h3 class="text-xl font-semibold text-slate-900 text-center">Settembre 2022</h3>
      </div>
      
      <!-- Carousel/Scroll Grid -->
      <div class="overflow-x-auto">
        <div class="grid grid-flow-col gap-4 p-6 auto-cols-[minmax(200px,1fr)]">
          <!-- Event Card per day -->
          <div class="bg-slate-50 rounded-lg p-4 min-w-[200px]">
            <h4 class="text-lg font-semibold text-slate-900 mb-4">
              <span>17</span>
              <span class="text-sm text-slate-600">mer</span>
            </h4>
            
            <!-- Events -->
            <div class="space-y-3">
              <a href="#" class="flex items-start gap-3 group">
                <img src="..." alt="" class="w-12 h-12 rounded object-cover flex-shrink-0">
                <span class="text-sm text-blue-600 group-hover:text-blue-800">Event title</span>
              </a>
              <a href="#" class="text-sm text-blue-600 group-hover:text-blue-800">Event title</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
```

## 📋 Tailwind Classes to Use

### Colors
- `bg-slate-50` / `bg-white` / `bg-slate-100`
- `text-slate-900` / `text-slate-600` / `text-slate-500`
- `border-slate-200` / `border-slate-300`
- `text-blue-600` / `text-blue-800`

### Spacing
- `py-16` / `py-20` (padding vertical)
- `px-4` / `px-6` / `px-8` (padding horizontal)
- `mb-2` / `mb-3` / `mb-4` / `mb-8` / `mb-12` (margin bottom)
- `gap-4` / `gap-6` (grid gap)

### Layout
- `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3` (responsive grid)
- `flex items-center` / `flex items-start`
- `max-w-6xl` (container)
- `mx-auto` (center)

### Typography
- `text-xs` / `text-sm` / `text-lg` / `text-xl` / `text-3xl`
- `font-semibold` / `font-bold`
- `uppercase` / `tracking-wide`

### Effects
- `shadow-sm` / `shadow-md`
- `hover:shadow-md` / `hover:text-blue-800`
- `rounded-lg`
- `border border-slate-200`
- `overflow-hidden`

### Responsive
- `lg:py-20` / `lg:px-8` / `lg:p-6`
- `md:grid-cols-2` / `lg:grid-cols-3`
- `group-hover:translate-x-1` / `group-hover:text-blue-800`

## ✅ Conversion Checklist

- [ ] Remove all `.section-muted`, `.card-wrapper`, `.card-teaser-*` classes
- [ ] Convert grid to `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6`
- [ ] Convert card styling to Tailwind
- [ ] Convert typography to Tailwind scale
- [ ] Add responsive padding/margin
- [ ] Improve hover states with Tailwind classes
- [ ] Convert carousel to CSS-based or Alpine.js-based (remove Splide if possible)
- [ ] Test on mobile (375px), tablet (768px), desktop (1024px+)
- [ ] Verify SVG icons load correctly
- [ ] Run `npm run build && npm run copy`

## 🧪 Success Criteria

- [ ] No Bootstrap Italia classes used
- [ ] Cards are responsive (1 col mobile, 2 col tablet, 3 col desktop)
- [ ] Typography is consistent and readable
- [ ] Hover states are clear
- [ ] Events carousel works smoothly
- [ ] No layout shifts on interaction
- [ ] Accessible (proper heading hierarchy, color contrast)

