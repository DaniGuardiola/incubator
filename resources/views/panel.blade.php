<md-layout style="flex: 1"><md-content><md-nav md-type="pinned" id="movements-nav" md-width="x4" md-color="white" md-shadow="shadow-1" style="flex-shrink: 0; transition: width 0.25s;">
		<md-toolbar md-color="cyan">
			<md-row md-type="small">
				<md-space></md-space>
				<md-icon-button md-image="icon: add" md-action="custom: addMovement"></md-icon-button>
			</md-row>
		</md-toolbar>
		<md-list data-discipline="{{{ $disciplineId }}}" class="movements-list" md-action="custom: movementListHandler">
<?php
$first = true;
$movements = $movements ?: [];
?>
		@foreach($movements as $movementItem)
			<md-tile class="{{{ $first ? 'open' : '' }}}" data-id="{{{ $movementItem->id }}}" style="{{{ $first ? 'border-left: 8px black solid;' : '' }}}">
<?php
if ($first) {
	$first = false;
}
?>
				<md-text>{{{ $movementItem->name }}}</md-text>
				<md-icon-button md-action="custom: deleteMovement" class="show-parent-hover" md-image="icon: delete"></md-icon-button>
			</md-tile>
		@endforeach
		</md-list>
	</md-nav>
	<div class="movement-form" md-color="grey-200" style="padding: 16px; flex-grow: 1; overflow-y: auto;">
		@include("movement")
	</div>
</md-content></md-body>