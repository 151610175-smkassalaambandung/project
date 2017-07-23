@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<ul class="breadcrumb">
					<li><a href="{{ url('/') }}">Dashboard</a></li>
					<li class="active">Pelajaran</li>
				</ul>
				<div class="panel panel-custom">
					<div class="panel-heading">
						<h2 class="panel-title">Pelajaran</h2>
					</div>

					<div class="panel-body">
					<p><a class="btn btn-sm btn-primary" href="{{route('pelajaran.create')}}"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah</a></p>
					{!! $html->table(['class'=>'table-striped']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! $html->scripts() !!}
@endsection