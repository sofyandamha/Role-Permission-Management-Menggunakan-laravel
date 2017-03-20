<div class="form-group <?php echo $errors->has('title') ? 'has-error' : ''; ?>">
  <?php echo Form::label('title', 'Title'); ?>

  <?php echo Form::text('title', null, ['class'=>'form-control']); ?>

  <?php echo $errors->first('title', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo $errors->has('parent_id') ? 'has-error' : ''; ?>">
  <?php echo Form::label('parent_id', 'Parent'); ?>

  <?php echo Form::select('parent_id', [''=>'']+App\Category::lists('title','id')->all(), null, ['class'=>'form-control']); ?>

  <?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

</div>

<?php echo Form::submit(isset($model) ? 'Update' : 'Save', ['class'=>'btn btn-primary']); ?>

