@extends('app')

@section('title')
Movimientos
@endsection

@section('js')
<script src="http://draggabilly.desandro.com/draggabilly.pkgd.min.js"></script>
@endsection

@section('toolbar')
<md-space></md-space>
<md-tabbar style="margin-top: 16px;" md-pager="main-pager" md-action="custom: tabHandler">
	<md-tab>Parkour</md-tab>
	<md-tab>Street Stunts</md-tab>
	<md-tab>Tricking</md-tab>
</md-tabbar>
@endsection

@section('content')
<md-fab md-image="icon: done" md-action="custom: saveMovement" md-color="green" md-fill="white" md-shadow="shadow-1"></md-fab>
<md-pager id="main-pager">
	<md-page style="display:flex;" class="parkour page">
<?php
$movements = $all['parkour'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
	<md-page style="display:flex;"  class="streetstunts page">
<?php
$movements = $all['streetstunts'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
	<md-page style="display:flex;"  class="tricking page">
<?php
$movements = $all['tricking'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
</md-pager>
@endsection
