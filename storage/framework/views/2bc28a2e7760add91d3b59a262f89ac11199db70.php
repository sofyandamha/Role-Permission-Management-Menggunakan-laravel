 
<?php $__env->startSection('content'); ?>

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Product</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-success" href="<?php echo e(route('Product.create')); ?>"> Create New Product</a>
	    
	        </div>
	    </div>
	</div>

	<?php if($message = Session::get('success')): ?>
		<div class="alert alert-success">
			<p><?php echo e($message); ?></p>
		</div>
	<?php endif; ?>

	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<td>Name</td>
              <td>Model</td>
              <td>Category</td>
			<th width="280px">Action</th>
		</tr>
	<?php foreach($products as $key => $product): ?>
	<tr>
		<td><?php echo e(++$i); ?></td>
		<td><?php echo e($product->name); ?></td>
              <td><?php echo e($product->model); ?></td>
              <td>
                <?php foreach($product->categories as $category): ?>
                  <span class="label label-primary">
                  <i class="fa fa-btn fa-tags"></i>
                  <?php echo e($category->title); ?></span>
                <?php endforeach; ?>
        
		<td>
			<a class="btn btn-info" href="<?php echo e(route('Product.show',$products->id)); ?>">Show</a>
		
			<a class="btn btn-primary" href="<?php echo e(route('Product.edit',$products->id)); ?>">Edit</a>
		

		
			<?php echo Form::open(['method' => 'DELETE','route' => ['Product.destroy', $product->id],'style'=>'display:inline']); ?>

            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

        	<?php echo Form::close(); ?>

        
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	<?php echo $products->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>