@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header  flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des produits</h2>
            @if(auth()->check() && auth()->user()->isAdmin())
                <div class="flex space-x-3">
                    <a href="{{ route('admin.products.export.csv') }}" class="btn bg-zinc-700 text-white">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Exporter CSV
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn border">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Nouveau produit
                    </a>
                </div>
            @endif
        </div>

        <div class="card-body">
            @if($products->isEmpty())
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Aucun produit disponible.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="card product-card">
                            <div class="p-5 product-card-content">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 mr-3 product-title">{{ $product->name }}</h3>
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200 shrink-0">
                                        {{ $product->category->name }}
                                    </span>
                                </div>

                                <p class="text-sm text-gray-600 leading-relaxed mb-4 product-description">{{ $product->description }}</p>

                                <div class="flex justify-between items-center mt-auto">
                                    <span class="text-lg font-bold text-blue-600">{{ number_format($product->price, 2) }} €</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium {{ $product->stock_quantity > 0 ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }} shrink-0">
                                        @if($product->stock_quantity > 0)
                                            <div class="w-1.5 h-1.5 bg-green-500 rounded-md mr-1.5"></div>
                                            En stock: {{ $product->stock_quantity }}
                                        @else
                                            <div class="w-1.5 h-1.5 bg-red-500 rounded-md mr-1.5"></div>
                                            Rupture de stock
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-between items-center">
                                <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir détails
                                </a>

                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
