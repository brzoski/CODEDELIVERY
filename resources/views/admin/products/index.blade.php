@extends('app')

@section('content')
<div class="container">
	<h3>Produtos</h3>
	<a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo Produto</a>
	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
			<th>ID</th>
			<th>NOME</th>
			<th>CATEGORIA</th>
			<th>PREÇO</th>
			<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $prod )
			<tr><?php //var_dump($prod); ?>
				<td>{{ $prod->id }}</td>
				<td>{{ $prod->name }}</td>
				<td>{{ $prod->category->name }}</td>
				<td>{{ $prod->price }}</td>
				<td>
					<a href="{{route('admin.products.edit',[ 'id' => $prod->id ])}}" class="btn btn-default btn-sm">Editar</a>
					<a href="{{route('admin.products.destroy',[ 'id' => $prod->id ])}}" class="btn btn-danger btn-sm">Apagar</a>
				</td>
			</tr>
			@endforeach
		</tbody>	
	</table>
	{!! $products->render() !!}

</div>
		

@endsection