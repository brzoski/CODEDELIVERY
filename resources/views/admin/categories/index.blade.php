@extends('app')

@section('content')
<div class="container">
	<h3>Categorias</h3>
	<a href="{{ route('admin.categories.create') }}" class="btn btn-default">Nova Categoria</a>
	<br><br>

	<table class="table table-bordered">
		<thead>
			<tr>
			<th>ID</th>
			<th>NOME</th>
			<th>AÇÃO</th>
			</tr>
		</thead>
		<tbody>
			@foreach($categories as $cat)
			<tr>
				<td>{{ $cat->id }}</td>
				<td>{{ $cat->name }}</td>
				<td><a href="{{route('admin.categories.edit',[ 'id' => $cat->id ])}}" class="btn btn-default btn-sm">Editar</a></td>
			</tr>
			@endforeach
		</tbody>	
	</table>
	{!! $categories->render() !!}

</div>
		

@endsection