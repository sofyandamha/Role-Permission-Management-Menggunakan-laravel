<div class="form-group <?php echo $errors->has('name') ? 'has-error' : ''; ?>">
  <?php echo Form::label('name', 'Name'); ?>

  <?php echo Form::text('name', null, ['class'=>'form-control']); ?>

  <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo $errors->has('model') ? 'has-error' : ''; ?>">
  <?php echo Form::label('model', 'Model'); ?>

  <?php echo Form::text('model', null, ['class'=>'form-control']); ?>

  <?php echo $errors->first('model', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo $errors->has('category_lists') ? 'has-error' : ''; ?>">
  <?php echo Form::label('category_lists', 'Categories'); ?>

  <?php /* Simplify things, no need to implement ajax for now */ ?>
  <?php echo Form::select('category_lists[]', [''=>'']+App\Category::lists('title','id')->all(), null, ['class'=>'form-control js-selectize-multiple', 'multiple']); ?>


  <?php echo $errors->first('category_lists', '<p class="help-block">:message</p>'); ?>

</div>

<div class="form-group <?php echo $errors->has('photo') ? 'has-error' : ''; ?>">
  <?php echo Form::label('photo', 'Product photo (jpeg, png)'); ?>

  <?php echo Form::file('photo'); ?>

  <?php echo $errors->first('photo', '<p class="help-block">:message</p>'); ?>


  <?php if(isset($model) && $model->photo !== ''): ?>
  <div class="row">
    <div class="col-md-6">
      <p>Current photo:</p>
      <div class="thumbnail">
        <img src="<?php echo e(url('/img/' . $model->photo)); ?>" class="img-rounded">
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php echo Form::submit(isset($model) ? 'Update' : 'Save', ['class'=>'btn btn-primary']); ?>

