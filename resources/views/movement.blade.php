@if($movement !== "none")
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
				$discipline = "[Street stunts]";
			} else if ($thisMovement->discipline_id == 3) {
				$discipline = "[Tricking]";
			}
			$equals[] = $thisMovement->name . " " . $discipline;
		} else {
			$equals[] = "[Movimiento eliminado: " . $value . "]";
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
			<md-input type="text" name="tags" placeholder="Etiquetas" value="{{{ $movement->tags ? implode(',', json_decode($movement->tags)) : '' }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.tags"></md-icon-button>
		</md-tile>
	</md-row>
	<md-row>
		<md-tile md-width="c1">
			<textarea style="width: 100%; min-height: 128px; border: none; outline: none;" name="history" placeholder="Historia">{{{ $movement->history }}}</textarea>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.history"></md-icon-button>
		</md-tile>
	</md-row>

	<!-- Discipline specific -->
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="headline" md-font-color="cyan">Específico de esta disciplina</span>
		</md-tile>
	</md-row>
	@if($movement->discipline_id === "1")

	@endif



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
			<md-icon-button md-action="custom: inputListAdd" data-list="steps" md-image="icon: add"></md-icon-button>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.steps"></md-icon-button>
		</md-tile>
	</md-row>
	<md-list class="numbered" name="steps" style="width: 100%;">
<?php
$stepcount = 1;
$movement->steps = $movement->steps ? json_decode($movement->steps) : [];
?>
@foreach([] as $value)
{{{ $movement->steps }}}
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
			<md-icon class="drag" md-image="icon: drag"></md-icon>
			<md-icon class="number" md-image="icon: looks_{{{ $stepcountstring }}}"></md-icon>
			<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-action="custom: inputListDeleteClick" md-image="icon: delete"></md-icon-button>
		</md-tile>
	@endforeach
	</md-list>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Consejos y errores comunes</span>
			<md-space></md-space>
			<md-icon-button md-action="custom: inputListAdd" data-list="advice" md-image="icon: add"></md-icon-button>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.advice"></md-icon-button>
		</md-tile>
	</md-row>
	<md-list name="advice" style="width: 100%;">
<?php
$movement->advice = $movement->advice ? json_decode($movement->advice) : [];
?>
			@foreach($movement->advice as $value)
		<md-tile>
			<md-icon class="drag" md-image="icon: drag"></md-icon>
			<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-action="custom: inputListDeleteClick" md-image="icon: delete"></md-icon-button>
		</md-tile>
	@endforeach
	</md-list>
	<md-row>
		<md-tile md-width="c1">
			<span md-typo="subhead">Progresiones</span>
			<md-space></md-space>
			<md-icon-button md-action="custom: inputListAdd" data-list="progressions" md-image="icon: add"></md-icon-button>
			<md-icon-button md-image="icon: help" md-action="custom: help.progressions"></md-icon-button>
		</md-tile>
	</md-row>
	<md-list name="progressions" style="width: 100%;">
{{{ $movement->progressions }}}
<?php
$movement->progressions = $movement->progressions ? json_decode($movement->progressions) : [];
?>
			@foreach([] as $value)
		<md-tile>
			<md-icon class="drag" md-image="icon: drag"></md-icon>
			<md-input style="flex: 1;" type="text" value="{{{ $value }}}"></md-input>
			<md-icon-button class="show-parent-hover" class="show-parent-hover" md-action="custom: inputListDeleteClick" md-image="icon: delete"></md-icon-button>
		</md-tile>
	@endforeach
	</md-list>
<?php
$requirements = [];
if ($movement->requirements) {
	foreach (json_decode($movement->requirements) as $key => $value) {
		$thisMovement = App\Models\Movement::find($value);
		if (!is_null($thisMovement)) {
			if ($thisMovement->discipline_id == 1) {
				$discipline = "[Parkour]";
			} else if ($thisMovement->discipline_id == 2) {
				$discipline = "[Street stunts]";
			} else if ($thisMovement->discipline_id == 3) {
				$discipline = "[Tricking]";
			}
			$requirements[] = $thisMovement->name . " " . $discipline;
		} else {
			$requirements[] = "[Movimiento eliminado: " . $value . "]";
		}
	}
}
?>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="requirements" placeholder="Requisitos" value="{{{ implode(', ', $requirements) }}}" data-value="{{{ $movement->requirements ? implode(',', json_decode($movement->requirements)) : "" }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.requirements"></md-icon-button>
		</md-tile>
	</md-row>
<?php
$derived_from = [];
if ($movement->derived_from) {
	foreach (json_decode($movement->derived_from) as $key => $value) {
		$thisMovement = App\Models\Movement::find($value);
		if (!is_null($thisMovement)) {
			if ($thisMovement->discipline_id == 1) {
				$discipline = "[Parkour]";
			} else if ($thisMovement->discipline_id == 2) {
				$discipline = "[Street stunts]";
			} else if ($thisMovement->discipline_id == 3) {
				$discipline = "[Tricking]";
			}
			$derived_from[] = $thisMovement->name . " " . $discipline;
		} else {
			$derived_from[] = "[Movimiento eliminado: " . $value . "]";
		}
	}
}
?>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="derived_from" placeholder="Derivado de..." value="{{{ implode(', ', $derived_from) }}}" data-value="{{{ $movement->derived_from ? implode(',', json_decode($movement->derived_from)) : "" }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.derived_from"></md-icon-button>
		</md-tile>
	</md-row>
<?php
$variations = [];
if ($movement->variations) {
	foreach (json_decode($movement->variations) as $key => $value) {
		$thisMovement = App\Models\Movement::find($value);
		if (!is_null($thisMovement)) {
			if ($thisMovement->discipline_id == 1) {
				$discipline = "[Parkour]";
			} else if ($thisMovement->discipline_id == 2) {
				$discipline = "[Street stunts]";
			} else if ($thisMovement->discipline_id == 3) {
				$discipline = "[Tricking]";
			}
			$variations[] = $thisMovement->name . " " . $discipline;
		} else {
			$variations[] = "[Movimiento eliminado: " . $value . "]";
		}
	}
}
\Log::debug(print_r($variations, true));
?>
	<md-row>
		<md-tile md-width="c1" style="cursor: pointer;">
			<md-input class="input-movement" disabled type="text" name="variations" placeholder="Variaciones" value="{{{ implode(', ', $variations) }}}" data-value="{{{ $movement->variations ? implode(',', json_decode($movement->variations)) : "" }}}"></md-input>
			<md-icon-button class="show-parent-hover" md-image="icon: help" md-action="custom: help.variations"></md-icon-button>
		</md-tile>
	</md-row>
</form>
@else
<md-paper md-padding md-shadow="shadow-1">
	<p md-typo="display-1" md-position="text-center-x">No hay movimientos en esta disciplina</p>
	<p md-typo="headline" md-position="text-center-x">Crea uno en el menú de la izquierda para comenzar</p>
</md-paper>
@endif