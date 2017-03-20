<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Category <small><a href="<?php echo e(route('categories.create')); ?>" class="btn btn-warning btn-sm">New Category</a></small></h3>
        <?php echo Form::open(['url' => 'categories', 'method'=>'get', 'class'=>'form-inline']); ?>

            <div class="form-group <?php echo $errors->has('q') ? 'has-error' : ''; ?>">
              <?php echo Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'Type category...']); ?>

              <?php echo $errors->first('q', '<p class="help-block">:message</p>'); ?>

            </div>

          <?php echo Form::submit('Search', ['class'=>'btn btn-primary']); ?>

        <?php echo Form::close(); ?>

        <table class="table table-hover">
          <thead>
            <tr>
              <td>Title</td>
              <td>Parent</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
              <td><?php echo e($category->title); ?></td>
              <td><?php echo e($category->parent ? $category->parent->title : ''); ?></td>
              <td>
                <?php echo Form::model($category, ['route' => ['categories.destroy', $category], 'method' => 'delete', 'class' => 'form-inline'] ); ?>

                 <a href="<?php echo e(route('categories.edit', $category->id)); ?>">Edit</a> |
                  <?php echo Form::submit('delete', ['class'=>'btn btn-xs btn-danger js-submit-confirm']); ?>

                <?php echo Form::close(); ?>

              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php echo $categories->links(); ?>

      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>