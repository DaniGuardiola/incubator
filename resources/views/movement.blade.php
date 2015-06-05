<form md-layout md-color="white" md-shadow="shadow-1" style="border-radius: 2px;">
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="headline" md-font-color="cyan">Información</span>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-input type="text" name="slug" placeholder="Identificador único" value="{{{ $movement->slug }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.slug"></md-icon-button>
		</md-tile>
		<md-tile style="width: auto;">
			<md-input style="margin-left: 16px; margin-top: 8px;" type="select" name="category_id" value="{{{ $movement->category_id ?: 1 }}}">
				<option value="1">Sin categoría</option>
			</md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.category"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-input type="text" name="name" placeholder="Nombre" value="{{{ $movement->name }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.name"></md-icon-button>
		</md-tile>
		<md-tile md-width="c1">
			<md-input type="text" name="name_variants" placeholder="Variantes de nombre" value="{{{ implode(',', json_decode($movement->name_variants)) }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.name_variants"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-input disabled type="text" name="equals" placeholder="Equivalentes" value="{{{ $movement->equals }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.equals"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-input type="text" name="tags" placeholder="Etiquetas" value="{{{ $movement->tags }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.tags"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<textarea style="width: 100%; min-height: 128px; border: none; outline: none;" name="history" placeholder="Historia">{{{ $movement->history }}}</textarea>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.history"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="headline" md-font-color="cyan">Técnica</span>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<textarea style="width: 100%; min-height: 128px; border: none; outline: none;" name="technique_description_text" placeholder="Descripción (que también es el guión para el vídeo)">{{{ $movement->technique_description_text }}}</textarea>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.technique_description_text"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Pasos</span>
			<md-space></md-space>
			<md-icon-button md-image="icon: add"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-icon md-image="icon: looks_one"></md-icon>
					<md-input style="flex: 1;" type="text" value="Pon las piernas de forma que X"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-icon md-image="icon: looks_two"></md-icon>
					<md-input style="flex: 1;" type="text" value="Impulsate hacia Y"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			</md-list>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Consejos y errores comunes</span>
			<md-space></md-space>
			<md-icon-button md-image="icon: add"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="No te caigas que no tenemos seguro"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="No es aconsejable saltar policías"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			</md-list>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Progresiones</span>
			<md-space></md-space>
			<md-icon-button md-image="icon: add"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="Primero haz esto"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="Y luego esto otro"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			</md-list>
		</md-tile>
	</md-row>
</form>