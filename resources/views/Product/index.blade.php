@extends('layouts.app')
 
@section('content')

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Product</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-success" href="{{ route('Product.create') }}"> Create New Product</a>
	    
	        </div>
	    </div>
	</div>

	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif

	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<td>Name</td>
              <td>Model</td>
              <td>Category</td>
			<th width="280px">Action</th>
		</tr>
	@foreach ($products as $key => $product)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $product->name }}</td>
              <td>{{ $product->model}}</td>
              <td>
                @foreach ($product->categories as $category)
                  <span class="label label-primary">
                  <i class="fa fa-btn fa-tags"></i>
                  {{ $category->title }}</span>
                @endforeach
        
		<td>
			<a class="btn btn-info" href="{{ route('Product.show',$products->id) }}">Show</a>
		
			<a class="btn btn-primary" href="{{ route('Product.edit',$products->id) }}">Edit</a>
		

		
			{!! Form::open(['method' => 'DELETE','route' => ['Product.destroy', $product->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        
		</td>
	</tr>
	@endforeach
	</table>

	{!! $products->render() !!}


@endsection