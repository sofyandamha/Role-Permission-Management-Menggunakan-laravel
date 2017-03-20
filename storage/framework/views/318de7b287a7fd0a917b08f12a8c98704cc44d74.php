 
<?php $__env->startSection('content'); ?>

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Users Management</h2>
	        </div>
			
			
	        <div class="pull-right">
				<?php if (\Entrust::can(('user-create'))) : ?>
	            <a class="btn btn-success" href="<?php echo e(route('users.create')); ?>"> Create New User</a>
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
			<th>Name</th>
			<th>Email</th>
			<th>Roles</th>
			<th width="280px">Action</th>
		</tr>
	<?php foreach($data as $key => $user): ?>
	<tr>
		<td><?php echo e(++$i); ?></td>
		<td><?php echo e($user->name); ?></td>
		<td><?php echo e($user->email); ?></td>
		<td>
			<?php if(!empty($user->roles)): ?>
				<?php foreach($user->roles as $v): ?>
					<label class="label label-success"><?php echo e($v->display_name); ?></label>
				<?php endforeach; ?>
			<?php endif; ?>
		</td>
		<td>
			<a class="btn btn-info" href="<?php echo e(route('users.show',$user->id)); ?>">Show</a>
			<?php if (\Entrust::can(('user-edit'))) : ?>
			<a class="btn btn-primary" href="<?php echo e(route('users.edit',$user->id)); ?>">Edit</a>
			<?php endif; // Entrust::can ?>
			
			<?php if (\Entrust::can(('user-delete'))) : ?>
			<?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']); ?>

            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

        	<?php echo Form::close(); ?>

			<?php endif; // Entrust::can ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>

	<?php echo $data->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>