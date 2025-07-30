@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Catégorie : {{ $category->name }}</h2>
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Voir toutes les catégories
            </a>
        </div>

        <div class="card-body">
            @if($products->isEmpty())
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">Aucun produit disponible dans cette catégorie.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="card product-card">
                            <div class="p-5 product-card-content">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 mr-3 product-title">{{ $product->name }}</h3>
                                    @if($product->category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200 shrink-0">
                                            {{ $product->category->name }}
                                        </span>
                                    @endif
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

                            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
                                <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-sm font-medium ">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
