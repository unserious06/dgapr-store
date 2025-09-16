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
        <h1>Commandes</h1>

        <!-- Flash messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Status filter -->
        <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="mb-3">
            <div class="d-inline-flex align-items-center gap-2">
                <label for="status" class="form-label mb-0">Filtrer par statut :</label>
                <select name="status" id="status"
                        class="form-select form-select-sm"
                        style="width: auto; min-width: 150px;"
                        onchange="this.form.submit()">
                    <option value="">Tous</option>
                    <?php $__currentLoopData = ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Rejetée', 'done' => 'Terminée']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(request('status') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select> 
            </div>  
        </form>

        <!-- Orders table -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Commande #</th>
                    <th>Client</th>
                    <th>Produits</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td>
                            <?php echo e($order->name); ?><br>
                            <?php echo e($order->phone); ?><br>
                            <?php echo e($order->email ?? '-'); ?>

                        </td>
                        <td>
                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($item->product->title); ?> 
                                (<?php echo e($item->quantity); ?> × <?php echo e(number_format($item->price, 2)); ?> MAD)<br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e(number_format($order->total, 2)); ?> MAD</td>
                        <td>
                            <form action="<?php echo e(route('admin.orders.updateStatus', $order)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <?php $__currentLoopData = ['pending'=>'En attente','accepted'=>'Acceptée','rejected'=>'Rejetée','done'=>'Terminée']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($order->status === $key ? 'selected' : ''); ?>>
                                            <?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        </td>
                        <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="btn btn-sm btn-primary">Voir</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($orders->links()); ?>

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
<?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>