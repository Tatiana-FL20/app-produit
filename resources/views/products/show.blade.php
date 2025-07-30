@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
            <span class="inline-flex items-center px-3 py-0.5 rounded-md text-sm font-medium bg-indigo-100 text-indigo-800">
                <a href="{{ route('products.by.category', $product->category->id) }}">
                    {{ $product->category->name }}
                </a>
            </span>
        </div>

        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <div class="prose max-w-none">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Détails</h3>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $product->id }}</dd>
                                </div>
                            @endif

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Référence</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $product->slug }}</dd>
                            </div>

                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Date de création</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Dernière mise à jour</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div>
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Prix</h3>
                            <span class="text-2xl font-bold text-indigo-600">{{ number_format($product->price, 2) }} €</span>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Disponibilité</h4>
                            <p class="text-lg {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                @if($product->stock_quantity > 10)
                                    En stock ({{ $product->stock_quantity }} disponibles)
                                @elseif($product->stock_quantity > 0)
                                    Stock limité ({{ $product->stock_quantity }} restants)
                                @else
                                    Rupture de stock
                                @endif
                            </p>
                        </div>

                        <div class="border-t pt-4 flex justify-between items-center gap-3">
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn bg-zinc-700 text-white w-full">
                                    Modifier
                                </a>
                            @endif
                            <a href="{{ route('home') }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300 w-full">
                                Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
