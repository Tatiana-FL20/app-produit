@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
            <div>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning mr-2">
                        Modifier
                    </a>
                @endif
                <a href="{{ route('products.by.category', $category->id) }}" class="btn btn-primary">
                    Voir les produits
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900">Détails de la catégorie</h3>
                <dl class="mt-2 border-t border-b border-gray-200 divide-y divide-gray-200">
                    <div class="py-3 flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">ID</dt>
                        <dd class="text-sm text-gray-900">{{ $category->id }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Nom</dt>
                        <dd class="text-sm text-gray-900">{{ $category->name }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Slug</dt>
                        <dd class="text-sm text-gray-900">{{ $category->slug }}</dd>
                    </div>
                    <div class="py-3 flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Nombre de produits</dt>
                        <dd class="text-sm text-gray-900">{{ $category->products->count() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
