@extends('app')

@section('content')
<div class="container">
	<h3>Editar Categoria: {{ $category->name }}</h3>

	@include('errors._check')
	 <!-- Form::open(['route'=>'admin.categories.store']) !!}
		<div class="form-group">
		 Form::label('Name', 'Nome:') !!}
		 Form::text('name', $category->name, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
		 Form::submit('Atualizar Categoria', ['class' => 'btn btn-primary']) !!}
		</div>
	 Form::close() !!} -->

	 	{!! Form::model($category, ['route'=>['admin.categories.update', $category->id]]) !!}

		@include('admin.categories._form')

		<div class="form-group">
		{!! Form::submit('Atualizar Categoria', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}

	<br>

</div>
		

@endsection