<?php if(!empty($attr)): ?>
    <input type="hidden" name="attr_id" value="<?php echo e($attr->id); ?>">
<?php endif; ?>
<div class="form-group">
    <label><?php echo e(__("Name")); ?></label>
    <input type="text" value="<?php echo e($translation->name); ?>" placeholder="<?php echo e(__("Term name")); ?>" name="name" class="form-control">
</div>
<?php if(is_default_lang()): ?>
    <div class="form-group">
        <label><?php echo e(__('Class Icon')); ?> - <?php echo __("get icon in <a href=':link_1' target='_blank'>fontawesome.com</a> or <a href=':link_2' target='_blank'>icofont.com</a>",['link_1'=>'https://fontawesome.com/v4.7.0/icons/','link_2'=>'https://icofont.com/icons']); ?></label>
        <input type="text" value="<?php echo e($row->icon); ?>" placeholder="<?php echo e(__("Ex: fa fa-facebook")); ?>" name="icon" class="form-control">
    </div>
    <div class="form-group">
        <label ><?php echo e(__('Upload image size 30px')); ?></label>
        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

        <i>
            <?php echo e(__("All the Term's image are same size")); ?>

        </i>
    </div>
<?php endif; ?><?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Tour/Views/admin/terms/form.blade.php ENDPATH**/ ?>