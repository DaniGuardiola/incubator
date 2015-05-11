@extends('app')

@section('content')
<md-layout id="movement" md-color="grey-200" style="padding: 0; flex-grow: 1; overflow-y: auto; display: flex;">
	<md-form>
		<md-row>
			<md-tile md-width="c1">

			</md-tile>
		</md-row>
	</md-form>
</md-layout>
<md-nav md-type="pinned" id="movements-nav" md-width="x4" md-color="white" md-shadow="shadow-1" style="flex-shrink: 0; transition: width 0.25s;">
	<md-toolbar md-color="cyan">
		<md-row md-type="small">
			<md-text style="margin-left: 8px">Movimientos</md-text>
			<md-space></md-space>
			<md-icon-button md-image="icon: add" md-action="custom: addMovement"></md-icon-button>
		</md-row>
	</md-toolbar>
	<md-list id="movements" md-action="custom: movementListHandler">
	</md-list>
</md-nav>
@endsection
