@extends('app')

@section('css')
<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
@endsection

@section('title')
Bienvenido
@endsection

@section('content')
<div class="container-fluid" style="margin-top: 64px;">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default" md-shadow="shadow-1">
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>¡Ups!</strong> Hay algunos problemas:<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="alert alert-info">
						<p>Para iniciar sesión, escribe tu nombre de usuario en minúsculas y añade "@email.com". Por ejemplo, si tu nombre de usuario es "pepe", escribe "pepe@email.com".</p>
					</div>

					<form md-layout role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<md-row>
							<md-tile md-width="c1">
								<md-input type="email" style="width: 100%;" placeholder="Email" name="email" value="{{ old('email') }}"></md-input>
							</md-tile>
						</md-row>
						<md-row>
							<md-tile md-width="c1">
								<md-input type="password" style="width: 100%;" placeholder="Contraseña" name="password"></md-input>
							</md-tile>
						</md-row>
						<md-row>
							<md-tile md-width="c1">
								<input type="checkbox" name="remember">Recordarme
							</md-tile>
						</md-row>
						<md-row>
							<md-tile md-width="c1">
								<md-button md-buttontype="flat-light" md-action="submit">Iniciar sesión</button>
							</md-tile>
						</md-row>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
