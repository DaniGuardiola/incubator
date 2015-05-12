@extends('app')

@section('title')
Movimientos
@endsection

@section('content')
<md-nav md-type="pinned" id="movements-nav" md-width="x4" md-color="white" md-shadow="shadow-1" style="flex-shrink: 0; transition: width 0.25s;">
	<md-toolbar md-color="cyan">
		<md-row md-type="small">
			<md-text style="margin-left: 8px">Movimientos</md-text>
			<md-space></md-space>
			<md-icon-button md-image="icon: add" md-action="custom: addMovement"></md-icon-button>
		</md-row>
	</md-toolbar>
	<md-list id="movements" md-action="custom: movementListHandler">
	@foreach($movements as $movement)
		<md-tile data-id="{{{ $movement->id }}}">
			<md-text>{{{ $movement->name }}}</md-text>
			<md-icon-button md-image="icon: delete"></md-icon-button>
		</md-tile>
	@endforeach
	</md-list>
</md-nav>
<div id="movement" md-color="grey-200" style="padding: 16px; flex-grow: 1; overflow-y: auto;">
	<form md-layout md-color="white" md-shadow="shadow-1" style="border-radius: 2px;">
		<md-row>
			<md-tile md-width="c1">
				<md-input type="text" name="name" placeholder="Nombre"></md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.name"></md-icon-button>
			</md-tile>
			<md-tile md-width="c1">
				<md-input type="text" name="slug" placeholder="Id"></md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.slug"></md-icon-button>
			</md-tile>
		</md-row>
		<md-row>
			<md-tile md-width="c1">
				<md-input type="select" name="discipline_id" value="parkour">
					<option value="parkour">Parkour</option>
					<option value="street-stunts">Street Stunts</option>
					<option value="tricking">Tricking</option>
				</md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.discipline"></md-icon-button>
			</md-tile>
			<md-tile md-width="c1">
				<md-input type="select" name="category_id" value="parkour">
					<option value="parkour">Parkour</option>
					<option value="street-stunts">Street Stunts</option>
					<option value="tricking">Tricking</option>
				</md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.category"></md-icon-button>
			</md-tile>
		</md-row>
		<md-row>
			<md-tile md-width="c1">
				<md-input type="text" name="video_id" placeholder="Vídeo"></md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.video"></md-icon-button>
			</md-tile>
			<md-tile md-width="c1">
				<md-input type="text" name="image_id" placeholder="Imagen"></md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.image"></md-icon-button>
			</md-tile>
			<md-tile md-width="c1">
				<md-input type="text" name="gif_id" placeholder="Gif"></md-input>
				<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.gif"></md-icon-button>
			</md-tile>
		</md-row>
	</form>
</div>
@endsection
