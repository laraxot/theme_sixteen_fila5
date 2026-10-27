<x-layouts.test>
  <x-section slug="header">
    <!-- Top bar (dark bg #006b4f) -->
    <div class="bg-[#006b4f] text-white py-4 md:py-6">
      <div class="container mx-auto px-4">
        <!-- Region link -->
        <x-nav-link :to="region.url" class="mr-6">
          <span class="font-medium">{{ config('app.name', 'Il mio Comune') }}</span>
        </div>
        <!-- Utility links -->
        <div class="flex space-x-4">
          <x-nav-link :to="/amministrazione-trasparente" class="hover:underline">Amministrazione trasparente</x-nav-link>
          <x-nav-link :to="/login" class="hover:underline">Accedi all’area personale</x-nav-link>
        </div>
        <!-- Social icons -->
        <div class="flex space-x-2 mt-2 md:mt-0">
          <a href="#" class="text-white hover:opacity-75"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white hover:opacity-75"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white hover:opacity-75"><i class="fab fa-youtube"></i></a>
        </div>
        <!-- Language switcher (Alpine dropdown) -->
        <div x-data="{ open: false }" class="ml-4">
          <button @click="open = !open" class="relative">
            <span class="absolute inset-0 flex items-center justify-center w-8 h-8 hidden md:block">🌐</span>
            <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
              <a href="/it" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">Italiano</a>
              <a href="/en" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">English</a>
            </div>
          </button>
        </div>
      </div>
    </div>

    <!-- Brand row -->
    <div class="container mx-auto px-4 py-6">
      <!-- Logo -->
      <div class="flex items-center">
        <img src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}" alt="Logo" class="h-14 w-14 mr-4">
        <!-- Brand name -->
        <span class="text-4xl font-bold text-white md:text-5xl">Nome del Comune</span>
        <!-- Tagline -->
        <span class="text-sm text-white md:text-sm md:ml-4">Un comune da vivere</span>
      </div>
    </div>

    <!-- Search button + mobile menu toggle -->
    <div class="container mx-auto px-4 py-4">
      <div class="flex items-center justify-between">
        <!-- Search button -->
        <button class="relative">
          <span class="absolute inset-0 flex items-center justify-center w-8 h-8 hidden md:block">🔍</span>
          <div x-show="openSearch" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50">
            <input type="text" placeholder="Cerca nel sito" class="w-full px-4 py-2 border border-gray-300 rounded">
          </div>
        </div>
        <!-- Mobile menu toggle -->
        <button @click="menuOpen = !menuOpen" class="lg:hidden">
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Primary nav (lg:flex) -->
    <div class="container mx-auto px-4 py-6">
      <nav class="lg:flex space-x-6">
        <x-nav-link :to="/amministrazione" :class="{ 'text-white font-bold': isActive('/amministrazione') }">Amministrazione</x-nav-link>
        <x-nav-link :to="/novita" :class="{ 'text-white font-bold': isActive('/novita') }">Novità</x-nav-link>
        <x-nav-link :to="/servizi" :class="{ 'text-white font-bold': isActive('/servizi') }">Servizi</x-nav-link>
        <x-nav-link :to="/eventi" :class="{ 'text-white font-bold': isActive('/eventi') }">Vivere il Comune</x-nav-link>
        <x-nav-link :to="/luoghi" :class="{ 'text-white font-bold': isActive('/luoghi') }">Luoghi</x-nav-link>
        <x-nav-link :to="/documenti-e-dati" :class="{ 'text-white font-bold': isActive('/documenti-e-dati') }">Documenti e dati</x-nav-link>
      </div>
    </div>
  </x-section>

  <x-section slug="footer">
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
      <div class="container mx-auto px-4">
        <!-- Brand -->
        <div class="flex items-center mb-6">
          <img src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}" alt="Logo" class="h-14 w-14 mr-4">
          <div>
            <span class="text-xl font-bold">Nome del Comune</span>
            <span class="text-sm text-gray-300">Servizi e informazioni del Comune.</span>
          </div>
        </div>

        <!-- Columns -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Column 1: Amministrazione -->
          <div>
            <h3 class="text-lg font-bold mb-4">Amministrazione</h3>
            <ul>
              <li><a href="/amministrazione" class="hover:underline">Organi di governo</a></li>
              <li><a href="/aree-amministrative" class="hover:underline">Aree amministrative</a></li>
              <!-- ... other links ... -->
            </ul>
          </div>
          <!-- Column 2: Categorie di servizio -->
          <div>
            <h3 class="text-lg font-bold mb-4">Categorie di servizio</h3>
            <ul>
              <li><a href="/anagrafe" class="hover:underline">Anagrafe e stato civile</a></li>
              <!-- ... other links ... -->
            </ul>
          </div>
          <!-- Column 3: Novità -->
          <div>
            <h3 class="text-lg font-bold mb-4">Novità</h3>
            <ul>
              <li><a href="/notizie" class="hover:underline">Notizie</a></li>
              <!-- ... other links ... -->
            </ul>
          </div>
          <!-- Column 4: Contatti -->
          <div>
            <h3 class="text-lg font-bold mb-4">Contatti</h3>
            <ul>
              <li><a href="/contatti" class="hover:underline">Comune di Nome Comune</a></li>
              <li><a href="/contatti" class="hover:underline">Via Roma 123 - 00100 Comune</a></li>
              <!-- ... other links ... -->
            </ul>
          </div>
        </div>

        <!-- Legal links -->
        <div class="mt-8">
          <h3 class="text-lg font-bold mb-4">Legal</h3>
          <ul class="space-y-2">
            <li><a href="/amministrazione-trasparente" class="hover:underline">Amministrazione trasparente</a></li>
            <li><a href="/privacy" class="hover:underline">Informativa privacy</a></li>
            <!-- ... other links ... -->
          </ul>
        </div>

        <!-- Social -->
        <div class="mt-8">
          <h3 class="text-lg font-bold mb-4">Social</h3>
          <div class="flex space-x-2">
            <a href="#" class="text-white hover:opacity-75"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white hover:opacity-75"><i class="fab fa-facebook"></i></a>
            <!-- ... other social links ... -->
          </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center text-sm">
          <p>© 2026 Nome del Comune. Tutti i diritti riservati.</p>
        </div>
      </div>
    </footer>
  </x-section>
</x-layouts.test>