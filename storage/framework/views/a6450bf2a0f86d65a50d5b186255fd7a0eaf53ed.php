<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Show on")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label><?php echo e(__("Include URLs")); ?></label>
            <div class="form-controls">
                <div class="form-group-item g-simple">
                    <div class="g-items">
                        <?php
                            $old = $row->include_url;
                        ?>
                        <?php $__currentLoopData = $old; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" ><?php echo e(url('/')); ?>/</span>
                                            </div>
                                            <input type="text" name="include_url[<?php echo e($key); ?>][url]" value="<?php echo e($item['url'] ?? ''); ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                    </div>
                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" ><?php echo e(url('/')); ?>/</span>
                                        </div>
                                        <input type="text" __name__="include_url[__number__][url]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p><i><?php echo e(__("Wildcard allowed. Eg: */checkout/* ")); ?></i></p>
        </div>
        <hr>
        <div class="form-group">
            <label><?php echo e(__("Exclude URLs")); ?></label>
            <div class="form-controls">
                <div class="form-group-item g-simple">
                    <div class="g-items">
                        <?php
                            $old = $row->exclude_url;
                        ?>
                        <?php if($old): ?>
                            <?php $__currentLoopData = $old; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item" data-number="<?php echo e($key); ?>">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" ><?php echo e(url('/')); ?>/</span>
                                                </div>
                                                <input type="text" name="exclude_url[<?php echo e($key); ?>][url]" value="<?php echo e($item['url'] ?? ''); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                    </div>
                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" ><?php echo e(url('/')); ?>/</span>
                                        </div>
                                        <input type="text" __name__="exclude_url[__number__][url]" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p><i><?php echo e(__("Wildcard allowed. Eg: */checkout/* ")); ?></i></p>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Popup/Views/admin/popup/conditions.blade.php ENDPATH**/ ?>