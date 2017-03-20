 
<?php $__env->startSection('content'); ?>

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Items CRUD</h2>
	        </div>
	        <div class="pull-right">
	        	<?php if (\Entrust::can(('item-create'))) : ?>
	            <a class="btn btn-success" href="<?php echo e(route('itemCRUD2.create')); ?>"> Create New Item</a>
	            <?php endif; // Entrust::can ?>
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
			<th>Title</th>
			<th>Description</th>
			<th width="280px">Action</th>
		</tr>
	<?php foreach($items as $key => $item): ?>
	<tr>
		<td><?php echo e(++$i); ?></td>
		<td><?php echo e($item->title); ?></td>
		<td><?php echo e($item->description); ?></td>
		<td>
			<a class="btn btn-info" href="<?php echo e(route('itemCRUD2.show',$item->id)); ?>">Show</a>
			<?php if (\Entrust::can(('item-edit'))) : ?>
			<a class="btn btn-primary" href="<?php echo e(route('itemCRUD2.edit',$item->id)); ?>">Edit</a>
			<?php endif; // Entrust::can ?>

			<?php if (\Entrust::can(('item-delete'))) : ?>
			<?php echo Form::open(['method' => 'DELETE','route' => ['itemCRUD2.destroy', $item->id],'style'=>'display:inline']); ?>

            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

        	<?php echo Form::close(); ?>

        	<?php endif; // Entrust::can ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	<?php echo $items->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>