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
        <h1>Réservations</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form method="GET" action="<?php echo e(route('admin.reservations.index')); ?>" class=" mb-3">
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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Quantité</th>
                    <th>Message</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($reservation->product->title); ?></td>
                        <td><?php echo e($reservation->name); ?></td>
                        <td><?php echo e($reservation->phone); ?></td>
                        <td><?php echo e($reservation->email ?? '-'); ?></td>
                        <td><?php echo e($reservation->quantity); ?></td>
                        <td><?php echo e(Str::limit($reservation->message, 30, '...') ?? '-'); ?></td>
                        <td>
                            <form action="<?php echo e(route('admin.reservations.updateStatus', $reservation)); ?>" method="POST" class="d-inline">
                                <?php echo method_field('PATCH'); ?>
                                <?php echo csrf_field(); ?>
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <?php $__currentLoopData = ['pending' => 'En attente', 'accepted' => 'Acceptée', 'rejected' => 'Rejetée', 'done' => 'Terminée']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($reservation->status === $key ? 'selected' : ''); ?>>
                                            <?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </form>
                        </td>
                        <td><?php echo e($reservation->created_at->format('d/m/Y H:i')); ?></td>
                        <td><!-- No delete/edit buttons --></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($reservations->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\majim\OneDrive\Documents\dgapr-store\resources\views/admin/reservations/index.blade.php ENDPATH**/ ?>