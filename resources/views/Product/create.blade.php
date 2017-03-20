@extends('layouts.app')
 
@section('content')

	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Create New Item</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('Product.index') }}"> Back</a>
	        </div>
	    </div>
	</div>

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	{!! Form::open(array('route' => 'Product.store','method'=>'POST')) !!}
	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {!! Form::label('name', 'Name') !!}
  {!! Form::text('name', null, ['class'=>'form-control']) !!}
  {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
               {!! Form::label('model', 'Model') !!}
  {!! Form::text('model', null, ['class'=>'form-control']) !!}
  {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
		
		
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
               {!! Form::label('category_lists', 'Categories') !!}
  {{-- Simplify things, no need to implement ajax for now --}}
  {!! Form::select('category_lists[]', [''=>'']+App\Category::lists('title','id')->all(), null, ['class'=>'form-control js-selectize-multiple', 'multiple']) !!}

  {!! $errors->first('category_lists', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
		
		
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
               {!! Form::label('photo', 'Product photo (jpeg, png)') !!}
  {!! Form::file('photo') !!}
  {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}

            </div>
			
			 @if (isset($model) && $model->photo !== '')
  <div class="row">
    <div class="col-md-6">
      <p>Current photo:</p>
      <div class="thumbnail">
        <img src="{{ url('/img/' . $model->photo) }}" class="img-rounded">
      </div>
    </div>
  </div>
  @endif
        </div>
		

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>

	</div>
	{!! Form::close() !!}

@endsection