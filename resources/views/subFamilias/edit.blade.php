@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sub Familia</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			
			{!!Form::model($subFamilia,['method'=>'PATCH','route'=>['subFamilias.update',$subFamilia->codiSubFamilia]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="">Familia</label>
				<select class="form-control" name="txt_codiFamilia">
					@foreach($familias as $familia)
						@if($familia->codiFamilia == $subFamilia->codiFamilia)
						<option value="{{ $familia->codiFamilia }}" selected>{{ $familia->nombreFamilia }}</option>
						@else
						<option value="{{ $familia->codiFamilia }}">{{ $familia->nombreFamilia }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Nombre Sub Familia</label>
				<input type="text" name="txt_nombreSubFamilia" required class="form-control" value="{{ $subFamilia->nombreSubFamilia }}">
			</div>
			<div class="form-group">
				<label for="">Nombre Breve</label>
				<input type="text" name="txt_nombreBreveSubFamilia" required class="form-control" value="{{ $subFamilia->nombreBreveSubFamilia }}">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Modificar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection