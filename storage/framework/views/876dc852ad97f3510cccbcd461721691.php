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
        <h1>Détails de la commande #<?php echo e($order->id); ?></h1>

        <!-- Flash success -->
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header">Informations client</div>
            <div class="card-body">
                <p><strong>Nom :</strong> <?php echo e($order->name); ?></p>
                <p><strong>Téléphone :</strong> <?php echo e($order->phone); ?></p>
                <p><strong>Email :</strong> <?php echo e($order->email ?? '-'); ?></p>
                <p><strong>Adresse :</strong> <?php echo e($order->shipping_address ?? '-'); ?></p>
               
            </div>
        </div>

        <!-- Order Items -->
        <div class="card mb-4">
            <div class="card-header">Produits</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->product->title); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(number_format($item->price, 2)); ?> MAD</td>
                                <td><?php echo e(number_format($item->quantity * $item->price, 2)); ?> MAD</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <span><strong>Date :</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?></span>
                <span><strong>Total :</strong> <?php echo e(number_format($order->total, 2)); ?> MAD</span>
            </div>
        </div>

        <!-- Status update -->
        <div class="card">
            <div class="card-header">Statut de la commande</div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <select name="status" onchange="this.form.submit()" class="form-select w-auto">
                        <?php $__currentLoopData = ['pending'=>'En attente','accepted'=>'Acceptée','rejected'=>'Rejetée','done'=>'Terminée']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e($order->status === $key ? 'selected' : ''); ?>>
                                <?php echo e($label); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
        </div>

        <!-- Back button -->
        <div class="mt-3">
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-secondary">← Retour aux commandes</a>
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
<?php endif; ?>
<?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>