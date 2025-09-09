<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
        
         
<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>

<!-- Cart Sidebar -->
<div id="cart-sidebar" class="fixed top-0 right-0 w-80 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="p-4 flex justify-between items-center border-b">
        <h2 class="text-lg font-bold">My Cart</h2>
        <button onclick="closeCartSidebar()" class="text-gray-600 hover:text-black">&times;</button>
    </div>
    <div id="cart-items" class="p-4 space-y-2 overflow-y-auto h-[calc(100%-4rem)]">
        <!-- Cart items will be injected here -->
    </div>
</div>

<!-- Overlay -->
<div id="cart-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="closeCartSidebar()"></div>


    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

                
            </main>
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
                                document.getElementById('cart-count').textContent = data.count; // update cart badge
                                
                                loadCartSidebar();  
                                openCartSidebar();

                                qtyInput.value = 1;
                                //alert(data.message);
                            } else {
                                alert("Something went wrong!");
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }

                    function openCartSidebar() {
                        document.getElementById("cart-sidebar").classList.remove("translate-x-full");
                        document.getElementById("cart-overlay").classList.remove("hidden");
                    }

                    function closeCartSidebar() {
                        document.getElementById("cart-sidebar").classList.add("translate-x-full");
                        document.getElementById("cart-overlay").classList.add("hidden");
                    }

                    function loadCartSidebar() {
                        fetch("<?php echo e(route('cart.sidebar')); ?>")
                            .then(response => response.json())
                            .then(data => {
                                let cartItemsDiv = document.getElementById("cart-items");
                                cartItemsDiv.innerHTML = ""; // clear

                                data.items.forEach(item => {
                                    cartItemsDiv.innerHTML += `
                                    <div>
                                    <div id="cart-item-sidebar-${item.id}" class="border p-2 rounded">
                                        <div class="flex items-center justify-between border-b pb-2">
                                            <img src="${item.image}" class="w-12 h-12 object-cover rounded" />
                                            <div class="flex-1 ml-3">
                                                <p class="font-medium">${item.title}</p>
                                                <p class="text-sm text-gray-600">${item.quantity} × ${item.price} MAD</p>
                                            </div>
                                            <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700">&times;</button>
                                        </div>
                                        <div class="mt-2 text-right font-semibold">
                                            Total: ${(item.quantity) * (item.price)} MAD
                                        </div>
                                    </div>
                                    `;
                                });
                            });
                    }


                    function removeFromCart(itemId) {
                        fetch(`/cart/remove/${itemId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('cart-count').textContent = data.count;
                                
                                
                                let row1 = document.getElementById('cart-item-sidebar-' + itemId);
                                if (row1) {row1.remove();}
                                let row2 = document.getElementById('cart-item-page-' + itemId);
                                if (row2) {row2.remove();}
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                    </script>

    </body>
</html>
<?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/components/app.blade.php ENDPATH**/ ?>