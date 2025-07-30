@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-xl font-semibold text-gray-800">Modifier la catégorie</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>

                    @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.categories.index') }}" class="btn bg-gray-200 text-gray-700 hover:bg-gray-300">
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
