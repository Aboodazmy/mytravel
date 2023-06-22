
<?php $__env->startSection('content'); ?>
    <div id="bravo_notify">
        <div class="container my-5">
            <div class="d-flex justify-content-between mb20">
                <h1 class="title-bar"><?php echo e(__('All Notifications')); ?></h1>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="panel">
                        <ul class="dropdown-list-items p-0">
                            <li class="notification <?php if(empty($type)): ?> active <?php endif; ?>">
                                <i class="fa fa-inbox fa-lg mr-2"></i> <a href="<?php echo e(route('core.notification.loadNotify')); ?>">&nbsp;<?php echo e(__('All')); ?></a>
                            </li>
                            <li class="notification <?php if(!empty($type) && $type == 'unread'): ?> active <?php endif; ?>">
                                <i class="fa fa-envelope-o fa-lg mr-2"></i> <a href="<?php echo e(route('core.notification.loadNotify', ['type'=>'unread'])); ?>"><?php echo e(__('Unread')); ?></a>
                            </li>
                            <li class="notification <?php if(!empty($type) && $type == 'read'): ?> active <?php endif; ?>">
                                <i class="fa fa-envelope-open-o fa-lg mr-2"></i> <a href="<?php echo e(route('core.notification.loadNotify', ['type'=>'read'])); ?>"><?php echo e(__('Read')); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php echo $__env->make('Core::frontend.notification.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Core/Views/frontend/notification/index.blade.php ENDPATH**/ ?>