<?php $__env->startSection('content'); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Search products</h3>
          </div>
          <div class="panel-body">
            <?php echo Form::open(['url' => 'catalogs', 'method'=>'get']); ?>

                <div class="form-group <?php echo $errors->has('q') ? 'has-error' : ''; ?>">
                  <?php echo Form::label('q', 'What are you looking for?'); ?>

                  <?php echo Form::text('q', isset($q) ? $q : null, ['class'=>'form-control']); ?>

                  <?php echo $errors->first('q', '<p class="help-block">:message</p>'); ?>

                </div>

                <?php echo Form::hidden('cat', isset($selected_category) ? $selected_category->id : ''); ?>


              <?php echo Form::submit('Search', ['class'=>'btn btn-primary']); ?>

            <?php echo Form::close(); ?>

          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Filter by category</h3>
          </div>
          <ul class="nav nav-pills nav-stacked">
            <li ><a href="/catalogs">All Products</a></li>
            <?php foreach(App\Category::all() as $category): ?>
              <li ><a href="<?php echo e(url('/catalogs?cat=' . $category->id)); ?>"><?php echo e($category->title); ?>

              <?php echo e($category->total_products > 0 ? '(' . $category->total_products . ')' : ''); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12"><h1>Category : <?php echo e(isset($selected_category) ? $selected_category->title : 'All'); ?></h1></div>
          <?php $__empty_1 = true; foreach($products as $product): $__empty_1 = false; ?>
            <div class="col-md-6">
              <h3><?php echo e($product->name); ?></h3>
              <div class="thumbnail">
                <img src="<?php echo e($product->photo_path); ?>" class="img-rounded">
                  <p>Model: <?php echo e($product->model); ?></p>
                  <p>Category:
                    <?php foreach($product->categories as $category): ?>
                      <a href="<?php echo e(url('/catalogs?cat=' . $category->id)); ?>">
                        <span class="label label-primary">
                        <i class="fa fa-btn fa-tags"></i>
                        <?php echo e($category->title); ?></span>
                      </a>
                    <?php endforeach; ?>
                  </p>
              </div>
            </div>
          <?php endforeach; if ($__empty_1): ?>
            <div class="col-md-12 text-center">
              <h1>:(</h1>
              <p>We can't find what you're looking for.</p>
            </div>
          <?php endif; ?>


          <div class="pull-right"><?php echo $products->links(); ?></div>
        </div>
      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>