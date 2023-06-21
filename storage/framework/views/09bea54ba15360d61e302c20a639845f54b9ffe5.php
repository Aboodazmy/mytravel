

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('popup.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ').$row->title : __('Add new popup')); ?></h1>
                </div>
                <div class="">
                    <?php if($row->id): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl(request()->query('lang'))); ?>" target="_blank"><?php echo e(__("Preview")); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($row->id): ?>
                <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <?php echo $__env->make('Popup::admin.popup.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if(is_default_lang()): ?>
                            <?php echo $__env->make('Popup::admin.popup.conditions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('Popup::admin.popup.schedule', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                            <div class="panel-body">
                                <?php if(is_default_lang()): ?>
                                    <div>
                                        <label><input <?php if($row->status=='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> <?php echo e(__("Publish")); ?>

                                        </label></div>
                                    <div>
                                        <label><input <?php if($row->status=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> <?php echo e(__("Draft")); ?>

                                        </label></div>
                                <?php endif; ?>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Popup/Views/admin/detail.blade.php ENDPATH**/ ?>