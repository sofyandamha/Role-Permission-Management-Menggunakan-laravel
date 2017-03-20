<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Edit <?php echo e($category->title); ?></h3>
        <?php echo Form::model($category, ['route' => ['categories.update', $category], 'method' =>'patch']); ?>

          <?php echo $__env->make('categories._form', ['model' => $category], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>