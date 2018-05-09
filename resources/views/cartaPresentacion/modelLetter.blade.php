@extends ('layouts.admin')
@section ('contenido')
<div class="container">
	<!-- header -->
	<div class="row" id="imprimible">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<img alt="logo" src="{{asset('img/logo.png')}}" style="width: 100%;" />
				</div>
				<div class="col-md-8">
					<div class="pull-right" role="group">
						 
						<button class="btn btn-secondary" type="button">
							Left
						</button> 
						<button class="btn btn-secondary" type="button">
							Center
						</button> 
						<button class="btn btn-secondary" type="button">
							Right
						</button> 
						<button class="btn btn-secondary" type="button">
							Justify
						</button>
					</div>
				</div>
			</div>
			<!-- fecha -->
			<div class="row">
				<div class="pull-right">
					<label>Huancayo, 21 Marzo de 2018</label>
				</div>
			</div>
			<!-- fin fecha -->
		</div>
	</div>
	<!-- fin header -->
	<div class="row">
		<div class="col-md-12">
			<span>
				<label>Señor(es):</label>
			</span><br>
			<span>
				<label>Atención:</label>
			</span>			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>
				Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
				</div>
				<div class="col-md-4">
					<img alt="Bootstrap Image Preview" src="https://www.layoutit.com/img/sports-q-c-140-140-3.jpg" />
				</div>
			</div>
		</div>
	</div>
</div>
@endsection