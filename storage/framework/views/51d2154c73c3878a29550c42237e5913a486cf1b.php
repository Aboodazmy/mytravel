<?php $translation = $row->translate(); ?>
<div class="mb-4">
    <?php if($image_tag = get_image_tag($row->image_id,'full',['alt'=>$translation->title,'class'=>'img-fluid mb-4 rounded-xs w-100'])): ?>
        <a class="d-block" href="<?php echo e($row->getDetailUrl()); ?>">
            <?php echo $image_tag; ?>

        </a>
    <?php endif; ?>
    <h5 class="font-weight-bold font-size-21 text-gray-3">
        <a href="<?php echo e($row->getDetailUrl()); ?>"><?php echo clean($translation->title); ?></a>
    </h5>
    <div class="mb-3">
        <a class="mr-3 pr-1" href="#">
            <span class="font-weight-normal text-gray-3"><?php echo e(display_date($row->updated_at)); ?></span>
        </a>
        <?php $category = $row->category; ?>
        <?php if(!empty($category)): ?>
            <?php $t = $category->translate(); ?>
            <a href="<?php echo e($category->getDetailUrl(app()->getLocale())); ?>">
                <span class="font-weight-normal"><?php echo e($t->name ?? ''); ?></span>
            </a>
        <?php endif; ?>
    </div>
    <p class="mb-0 text-lh-lg">
        <?php echo $translation->content; ?>

    </p>
    <div class="space-between">
        <?php if(!empty($tags = $row->getTags()) and count($tags) > 0): ?>
            <div class="tags">
                <?php echo e(__("Tags:")); ?>

                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $t = $tag->translate(); ?>
                    <a href="<?php echo e($tag->getDetailUrl(app()->getLocale())); ?>" class="tag-item"> <?php echo e($t->name ?? ''); ?> </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="share"> <?php echo e(__("Share")); ?>

            <a class="facebook share-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" original-title="<?php echo e(__("Facebook")); ?>"><i class="fa fa-facebook fa-lg"></i></a>
            <a class="twitter share-item" href="https://twitter.com/share?url=<?php echo e($row->getDetailUrl()); ?>&amp;title=<?php echo e($translation->title); ?>" target="_blank" original-title="<?php echo e(__("Twitter")); ?>"><i class="fa fa-twitter fa-lg"></i></a>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\m\Desktop\MyTravel\themes/Mytravel/News/Views/frontend/layouts/details/news-detail.blade.php ENDPATH**/ ?>