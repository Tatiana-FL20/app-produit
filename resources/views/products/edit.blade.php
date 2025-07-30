@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-xl font-semibold text-gray-800">Modifier le produit</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>

                    @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select name="category_id" id="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('category_id') border-red-500 @enderror" required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>

                    @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2 mb-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md @error('price') border-red-500 @enderror" required>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                        </div>

                        @error('price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Quantité en stock</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" min="0" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('stock_quantity') border-red-500 @enderror" required>

                        @error('stock_quantity')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.products.index') }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-warning">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
