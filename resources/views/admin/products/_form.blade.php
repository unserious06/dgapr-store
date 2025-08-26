@csrf

<div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title ?? '') }}" required>
</div>

<div class="mb-4">
    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
    <select name="category_id" id="category_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"{{ old('category_id', isset($product) ? $product->category_id : null) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>


<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="price" class="form-label">Prix (MAD)</label>
    <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}" required>
</div>


    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" {{ old('is_visible', $product->is_visible ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_visible">
            Visible
        </label>
    </div>


<button type="submit" class="btn btn-primary">Enregistrer</button>