
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
   

<div class="container my-4">
    <h2 class="mb-4">Votre panier</h2>

<?php if (isset($component)) { $__componentOriginal5b09c79149dfb771c232996af5f9dae4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5b09c79149dfb771c232996af5f9dae4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.flash-messages','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash-messages'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5b09c79149dfb771c232996af5f9dae4)): ?>
<?php $attributes = $__attributesOriginal5b09c79149dfb771c232996af5f9dae4; ?>
<?php unset($__attributesOriginal5b09c79149dfb771c232996af5f9dae4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5b09c79149dfb771c232996af5f9dae4)): ?>
<?php $component = $__componentOriginal5b09c79149dfb771c232996af5f9dae4; ?>
<?php unset($__componentOriginal5b09c79149dfb771c232996af5f9dae4); ?>
<?php endif; ?>

    <?php if($items->isEmpty()): ?>
        <div class="alert alert-info">
            Votre panier est vide.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="cart-item-page-<?php echo e($item->id); ?>">
                                <td><?php echo e($item->product->title); ?></td>
                                <td><?php echo e(number_format($item->product->price, 2)); ?> MAD</td>
                                <td class="text-center"><?php echo e($item->quantity); ?></td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-danger" onclick="removeFromCart(<?php echo e($item->id); ?>)">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                 
                
            </div>
        </div>
        <div class="text-end">
                  
            <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                Réserver
            </button>

    <!-- Modal Form -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('orders.storeFromCart')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Informations pour la commande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Téléphone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Adresse</label>
                            <textarea name="shipping_address" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Confirmer la commande</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        </div>
    <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/cart/index.blade.php ENDPATH**/ ?>