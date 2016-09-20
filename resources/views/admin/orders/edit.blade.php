@extends('app')

@section('content')
<div class="container">
	<h2> Pedido #{{ $order->id }} -- {{$order->total}} </h2>
	<h4>Cliente: {{ $order->client->user->name }}</h4>
	<h5>Data: {{ $order->created_at }}</h5>
	<br>
	<p><b>Entregar em:</b></p>
	{{ $order->client->address }} |
	{{ $order->client->city }}/{{ $order->client->state }}

	{!! Form::model($order, ['route'=>['admin.orders.update', $order->id]]) !!}

		@include('admin.orders._form')

		<div class="form-group">
		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
</div>

@endsection