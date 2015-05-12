<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<?php Log::debug(action('HomeController@getMovement'))?>

	@yield('css')
	<link href="{{ asset('/paperkit-min/paperkit.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body md-layout>
	<md-toolbar md-color="cyan" md-shadow="shadow-1">
		<md-row md-type="standard">
			@if (!Auth::guest())
			<md-icon-button md-image="icon: menu" md-action="custom: paperkit.sidemenu.open"></md-icon-button>
			@else
			<md-icon></md-icon>
			@endif
			<md-text>Incubator - <span md-font-color="cyan-100">
			@yield('title')
			</span>
			</md-text>
			<md-space></md-space>
			@if (!Auth::guest())
<?php
$msg = [
	"Bienvenido de nuevo, %s",
	"Sayonara %s",
	"¡Hey, %s!",
	"Hola %s",
	"¿Cómo va eso %s?",
];
$msg = $msg[mt_rand(0, count($msg) - 1)];
?>
				<md-text>{{ sprintf($msg, Auth::user()->name) }}</md-text>
				<md-icon-button md-image="icon: cancel" md-action="link: {{ url('/auth/logout') }}"></md-icon-button>
			@endif
		</md-row>
	</md-toolbar>
	<md-sidemenu>
		<md-list md-action="link: data-action">
			<md-tile data-action="{{{ url('home') }}}">
				<md-icon md-image="icon: run"></md-icon>
				<md-text>Movimientos</md-text>
			</md-tile>
		</md-list>
	</md-sidemenu>
	<md-content md-color="grey-200">
	@yield('content')
	</md-content>

	<!-- Scripts -->
	<script src="{{ asset('/paperkit-min/paperkit.js') }}"></script>
	<script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
