@extends('app')

@section('content')
<div class="container">
	<h3>Editar Cliente: {{ $client->user->name }}</h3>

	@include('errors._check')
	 <!-- Form::open(['route'=>'admin.clients.store']) !!}
		<div class="form-group">
		 Form::label('Name', 'Nome:') !!}
		 Form::text('name', $client->name, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
		 Form::submit('Atualizar Cliente', ['class' => 'btn btn-primary']) !!}
		</div>
	 Form::close() !!} -->

	 	{!! Form::model($client, ['route'=>['admin.clients.update', $client->id]]) !!}

		@include('admin.clients._form')

		<div class="form-group">
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		</div>
		{!! Form::close() !!}

	<br>

</div>
		

@endsection