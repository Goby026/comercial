{!! Form::open(array('url'=>'cotizaciones','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
	<div class="input-group">
		@if (isset($searchText))
			<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		@else
			<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="">
		@endif
		
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>
{{Form::close()}}