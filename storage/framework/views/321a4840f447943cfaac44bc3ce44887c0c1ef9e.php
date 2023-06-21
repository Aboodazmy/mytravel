<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Schedule")); ?></strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__("Show every")); ?></label>
                    <input type="number" name="schedule_amount" min="1" value="<?php echo e(old('schedule_amount',$row->schedule_amount)); ?>" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo e(__("Type")); ?></label>
                    <select class="form-control" name="schedule_type">
                        <option value="day" <?php if($row->schedule_type == 'day'): ?> selected <?php endif; ?> ><?php echo e(__("Day")); ?></option>
                        <option value="month" <?php if($row->schedule_type == 'month'): ?> selected <?php endif; ?> ><?php echo e(__("Month")); ?></option>
                        <option value="year" <?php if($row->schedule_type == 'year'): ?> selected <?php endif; ?> ><?php echo e(__("Year")); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\m\Desktop\MyTravel\modules/Popup/Views/admin/popup/schedule.blade.php ENDPATH**/ ?>