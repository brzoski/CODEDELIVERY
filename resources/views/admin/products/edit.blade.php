@extends('app')

@section('content')
<div class="container">
	<h3>Editando Produto: {{ $product->name }}</h3>

	@include('errors._check')
	 <!-- Form::open(['route'=>'admin.products.store']) !!}
		<div class="form-group">
		 Form::label('Name', 'Nome:') !!}
		 Form::text('name', $product->name, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
		 Form::submit('Atualizar Produto', ['class' => 'btn btn-primary']) !!}
		</div>
	 Form::close() !!} -->

	 	{!! Form::model($product, ['route'=>['admin.products.update', $product->id]]) !!}

		@include('admin.products._form')

		<div class="form-group">
		{!! Form::submit('Atualizar Produto', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}

	<br>

</div>
		

@endsection