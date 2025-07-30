@php use App\Models\Category; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Design system personnalisé */
        .nav-link {
            position: relative;
            transition: all 0.2s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #863bf6, #8b5cf6);
            transition: all 0.2s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* Consistent card styling */
        .card {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background-color: white;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-body {
            padding: 1rem;
        }

        .card-footer {
            padding: 1rem;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        /* Button styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        /* Product card consistent height */
        .product-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-title {
            min-height: 2rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-description {
            min-height: 4.5rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-900 antialiased">

<div class="min-h-screen flex flex-col">
    <!-- Navbar épuré -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo simple -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-8 h-8 bg-violet-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="font-semibold text-xl text-gray-900">Catalog</span>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link px-1 py-2 text-sm font-medium text-gray-700 hover:text-violet-600">
                        Accueil
                    </a>

                    @php $categories = Category::all(); @endphp
                    @if($categories->count())
                        <div class="relative group">
                            <button class="nav-link flex items-center px-1 py-2 text-sm font-medium text-gray-700 hover:text-violet-600">
                                Catégories
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 absolute left-0 mt-2 w-56 bg-white rounded-lg border border-gray-100 py-1 transition-all duration-150">
                                @foreach($categories as $cat)
                                    <a href="{{ route('products.by.category', $cat->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-violet-600">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- User actions -->
                <div class="hidden md:flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-violet-600">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Inscription
                        </a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="w-7 h-7 bg-violet-600 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-semibold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="invisible opacity-0 group-hover:visible group-hover:opacity-100 absolute right-0 mt-2 w-48 bg-white rounded-lg border border-gray-100 py-1 transition-all duration-150">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        Gestion catégories
                                    </a>
                                    <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        Gestion produits
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="fixed top-0 left-0 w-72 h-full bg-white border-r border-gray-200 transform -translate-x-full transition-transform duration-200 z-50">
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-violet-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-xl text-gray-900">Catalog</span>
                </div>
                <button id="mobile-menu-close" class="p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-violet-600">
                    Accueil
                </a>

                @if($categories->count())
                    <div class="py-2">
                        <div class="px-3 py-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégories</div>
                        @foreach($categories as $cat)
                            <a href="{{ route('products.by.category', $cat->id) }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-violet-600">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                <div class="pt-4 mt-4 border-t border-gray-200">
                    @guest
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 mb-2">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700">
                            Inscription
                        </a>
                    @else
                        <div class="px-3 py-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mon compte</div>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                                Gestion catégories
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50">
                                Gestion produits
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                                Déconnexion
                            </button>
                        </form>
                    @endguest
                </div>
            </nav>
        </div>

        <div id="mobile-menu-backdrop" class="fixed inset-0 bg-black/20 z-40 hidden"></div>
    </nav>

    <!-- Flash messages -->
    @if(session('success') || session('error'))
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            @if(session('success'))
                <div class="bg-green-50 text-green-800 p-4 rounded-lg border border-green-200" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 text-red-800 p-4 rounded-lg border border-red-200" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <main class="flex-1 md:w-[70%] mx-auto py-8 px-4 sm:px-6 lg:px-8 ">
        <div class="w-full">
            @yield('content')
        </div>
    </main>

    <!-- Footer minimaliste -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <span class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Catalog. Tous droits réservés.
                </span>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script>
    const menuBtn = document.getElementById('mobile-menu-toggle');
    const closeBtn = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('mobile-menu-backdrop');

    function openMenu() {
        mobileMenu.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        document.body.style.overflow = '';
    }

    menuBtn?.addEventListener('click', openMenu);
    closeBtn?.addEventListener('click', closeMenu);
    backdrop?.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeMenu();
    });
</script>

</body>
</html>
