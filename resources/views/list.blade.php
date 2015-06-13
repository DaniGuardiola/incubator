<md-layout style="width: 100%; height: 100%;">
	<md-toolbar md-color="cyan-700">
		<md-row md-type="small">
		<md-icon-button md-action="custom: closeMorph" md-image="icon: close"></md-icon-button>
			<md-tabbar md-pager="movement-list-pager">
				<md-tab>Parkour</md-tab>
				<md-tab>Street Stunts</md-tab>
				<md-tab>Tricking</md-tab>
			</md-tabbar>
		<md-space></md-space>
		</md-row>
	</md-toolbar>
	<md-content>
		<md-pager id="movement-list-pager">
			<md-page>
				<md-list md-action="custom: inputMovementListHandler">
					@foreach($movements["parkour"] as $movement)
					<md-tile>
						<md-text>{{{ $movement->name }}}</md-text>
					</md-tile>
					@endforeach
				</md-list>
			</md-page>
			<md-page>
				<md-list md-action="custom: inputMovementListHandler">
					@foreach($movements["streetstunts"] as $movement)
					<md-tile>
						<md-text>{{{ $movement->name }}}</md-text>
					</md-tile>
					@endforeach
				</md-list>
			</md-page>
			<md-page>
				<md-list md-action="custom: inputMovementListHandler">
					@foreach($movements["tricking"] as $movement)
					<md-tile>
						<md-text>{{{ $movement->name }}}</md-text>
					</md-tile>
					@endforeach
				</md-list>
			</md-page>
		</md-pager>
	</md-content>
</md-layout>