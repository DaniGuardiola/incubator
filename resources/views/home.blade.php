@extends('app')

@section('title')
Movimientos
@endsection

@section('toolbar')
<md-space></md-space>
<md-tabbar style="margin-top: 16px;" md-pager="main-pager">
	<md-tab>Parkour</md-tab>
	<md-tab>Street Stunts</md-tab>
	<md-tab>Tricking</md-tab>
</md-tabbar>
@endsection

@section('content')
<md-pager id="main-pager">
	<md-page style="display:flex;">
<?php
$movements = $all['parkour'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
	<md-page style="display:flex;">
<?php
$movements = $all['streetstunts'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
	<md-page style="display:flex;">
<?php
$movements = $all['tricking'];
$movement = $movements[0];
?>
	@include('panel')
	</md-page>
</md-pager>
@endsection
