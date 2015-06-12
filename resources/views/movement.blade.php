<form class="movement" data-csrf="<?php echo csrf_token();?>" data-id="{{{ $movement->id }}}" md-layout md-color="white" md-shadow="shadow-1" style="border-radius: 2px;">
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
			<md-input type="text" name="name_variants" placeholder="Variantes de nombre" value="{{{ $movement->name_variants ? implode(',', json_decode($movement->name_variants)) : "" }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.name_variants"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
<?php
$equals = [];
if ($movement->equals) {
	foreach (json_decode($movement->equals) as $key => $value) {
		$thisMovement = App\Models\Movement::find($value);
		if (!is_null($thisMovement)) {
			if ($thisMovement->discipline_id == 1) {
				$discipline = "[Parkour]";
			} else if ($thisMovement->discipline_id == 2) {
				$discipline = "[Street Stunts]";
			} else if ($thisMovement->discipline_id == 3) {
				$discipline = "[Tricking]";
			}
			$equals[] = $discipline . " " . $thisMovement->name;
		}
	}
}
?>
			<md-input class="input-movement" disabled type="text" name="equals" placeholder="Equivalentes" value="{{{ implode(', ', $equals) }}}" data-value="{{{ $movement->equals ? implode(',', json_decode($movement->equals)) : "" }}}"></md-input>
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
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.steps"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
<?php
$stepcount = 1;
$movement->steps = $movement->steps ? json_decode($movement->steps) : [];
?>
			@foreach($movement->steps as $value)
<?php
if ($stepcount === 1) {
	$stepcountstring = "one";
} else if ($stepcount === 2) {
	$stepcountstring = "two";
} else if ($stepcount === 3) {
	$stepcountstring = "3";
} else if ($stepcount === 4) {
	$stepcountstring = "4";
} else if ($stepcount === 5) {
	$stepcountstring = "5";
} else {
	$stepcountstring = "6";
}
$stepcount = $stepcount + 1;
?>
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-icon md-image="icon: looks_{{{ $stepcountstring }}}"></md-icon>
					<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			@endforeach
			</md-list>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Consejos y errores comunes</span>
			<md-space></md-space>
			<md-icon-button md-image="icon: add"></md-icon-button>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.advice"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
<?php
$movement->advice = $movement->advice ? json_decode($movement->advice) : [];
?>
			@foreach($movement->advice as $value)
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			@endforeach
			</md-list>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Progresiones</span>
			<md-space></md-space>
			<md-icon-button md-image="icon: add"></md-icon-button>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.progressions"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<md-list style="width: 100%;">
<?php
$movement->progressions = $movement->progressions ? json_decode($movement->progressions) : [];
?>
			@foreach($movement->progressions as $value)
				<md-tile>
					<md-icon md-image="icon: drag"></md-icon>
					<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
					<md-icon-button md-image="icon: delete"></md-icon-button>
				</md-tile>
			@endforeach
			</md-list>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="requirements" placeholder="Requisitos" value="{{{ $movement->requirements }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.requirements"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="derived_from" placeholder="Derivado de..." value="{{{ $movement->derived_from }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.derived_from"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="variations" placeholder="Variaciones" value="{{{ $movement->variations }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.variations"></md-icon-button>
		</md-tile>
	</md-row>
</form>