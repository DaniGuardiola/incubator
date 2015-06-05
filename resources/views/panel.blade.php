<md-layout style="flex: 1"><md-content><md-nav md-type="pinned" id="movements-nav" md-width="x4" md-color="white" md-shadow="shadow-1" style="flex-shrink: 0; transition: width 0.25s;">
		<md-toolbar md-color="cyan">
			<md-row md-type="small">
				<md-space></md-space>
				<md-icon-button md-image="icon: add" md-action="custom: addMovement"></md-icon-button>
			</md-row>
		</md-toolbar>
		<md-list class="movements-list" md-action="custom: movementListHandler">
		@foreach($movements as $movementItem)
			<md-tile data-id="{{{ $movementItem->id }}}">
				<md-text>{{{ $movementItem->name }}}</md-text>
				<md-icon-button class="show-parent-hover" md-image="icon: delete"></md-icon-button>
			</md-tile>
		@endforeach
		</md-list>
	</md-nav>
	<div class="movement-form" md-color="grey-200" style="padding: 16px; flex-grow: 1; overflow-y: auto;">
		@include("movement")
	</div>
</md-content></md-body>