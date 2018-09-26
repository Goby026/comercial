@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Lista de usuarios comerciales<a href="usersComercial/create"><button class="btn btn-success pull-right">Nuevo usuario</button></a></h3>
			@include('usersComercial.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>NOMBRES COMPLETOS</th>
						<th>USUARIO</th>
						<th>EMAIL</th>
						<th>CARGO</th>
						<th>AREA</th>
						<th>Estado</th>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->username}}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->nombreCargo }}</td>
							<td>{{ $user->nombreArea }}</td>
							<td>ACTIVADO</td>
							<td>
								<a href="{{URL::action('UserController@edit',$user->id)}}"><button class="btn btn-warning">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$user->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('usersComercial.modal') <!-- incluimos el archivo del modal -->
						@endforeach
					</tbody>
				</table>
			</div>
			<!-- paginacion -->
			{{$users->render()}}
			<!-- fin paginacion -->
		</div>
	</div>
@endsection