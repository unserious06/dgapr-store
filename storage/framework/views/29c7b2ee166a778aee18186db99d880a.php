<?php echo csrf_field(); ?>

<div class="mb-3">
    <label for="title" class="form-label">Titre</label>
    <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $product->title ?? '')); ?>" required>
</div>

<div class="mb-4">
    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
    <select name="category_id" id="category_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Select Category</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>"<?php echo e(old('category_id', isset($product) ? $product->category_id : null) == $category->id ? 'selected' : ''); ?>>
                <?php echo e($category->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" id="description" class="form-control" rows="4" required><?php echo e(old('description', $product->description ?? '')); ?></textarea>
</div>

<div class="mb-3">
    <label for="price" class="form-label">Prix (MAD)</label>
    <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?php echo e(old('price', $product->price ?? '')); ?>" required>
</div>

<div class="mb-3">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" name="stock" id="stock" class="form-control" value="<?php echo e(old('stock', $product->stock ?? '')); ?>" required>
</div>


    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" <?php echo e(old('is_visible', $product->is_visible ?? true) ? 'checked' : ''); ?>>
        <label class="form-check-label" for="is_visible">
            Visible
        </label>
    </div>


<button type="submit" class="btn btn-primary">Enregistrer</button><?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/admin/products/_form.blade.php ENDPATH**/ ?>