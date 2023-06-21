
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('tour.admin.attribute.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb20">
                        <div class="">
                            <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ').$row->name : __('Add new attribute')); ?></h1>
                        </div>
                    </div>
                    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if($row->id): ?>
                        <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <div class="lang-content-box">
                        <div class="panel">
                            <div class="panel-title">
                                <strong><?php echo e(__("Attribute Content")); ?></strong>
                            </div>
                            <div class="panel-body">
                                <?php echo $__env->make('Tour::admin/attribute/form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <button class="btn btn-primary" type="submit"><?php echo e(__("Save Change")); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Tour/Views/admin/attribute/detail.blade.php ENDPATH**/ ?>