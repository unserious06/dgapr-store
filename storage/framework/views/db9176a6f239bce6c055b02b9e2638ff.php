<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container py-4">

        <form method="GET" action="<?php echo e(route('home')); ?>" class="mb-4">
    <div class="row g-2">
        <!-- Search bar -->
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search products..."
                       value="<?php echo e(request('search')); ?>">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> <!-- Bootstrap search icon -->
                </button>
            </div>
        </div>

        <!-- Category filter -->
        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" 
                        <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</form>


        <div class="row">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 mb-4 h-100">
                    <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="no-underline text-dark">
                        <div class="card shadow h-100">
                                <div style="height: 300px; overflow: hidden;">

                                        <img src="<?php echo e(asset(optional($product->images->first())->path ?? 'placeholder.jpg')); ?>"
                                        class="card-img-top img-fluid object-fit-cover w-100 h-100"
                                        alt="<?php echo e($product->title); ?>">
                                </div>
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo e($product->title); ?></h5>
                                    <p class="text-primary fw-bold"><?php echo e($product->price); ?> MAD</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <div class="input-group" style="width: 140px;">
                            <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty(<?php echo e($product->id); ?>)">−</button>

                            <input type="number" id="qty-<?php echo e($product->id); ?>" class="form-control text-center" value="1" min="1">

                            <button type="button" class="btn btn-outline-secondary" onclick="increaseQty(<?php echo e($product->id); ?>)">+</button>
                        </div>

                        <button type="button" class="btn btn-primary ms-2" onclick="addToCart(<?php echo e($product->id); ?>)">Add to Cart</button>
                    </div>

                <script>
                    function increaseQty(id) {
                        let input = document.getElementById('qty-' + id);
                        input.value = parseInt(input.value) + 1;
                    }

                    function decreaseQty(id) {
                        let input = document.getElementById('qty-' + id);
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    }

                    function addToCart(productId) {
                        let qtyInput = document.getElementById('qty-' + productId);
                        let quantity = parseInt(qtyInput.value);

                        fetch(`/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ quantity: quantity })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('cart-count').textContent = data.count; // 🔥 update badge
                                //alert(data.message);
                            } else {
                                alert("Something went wrong!");
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                    </script>


                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($products->links()); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/products/index.blade.php ENDPATH**/ ?>