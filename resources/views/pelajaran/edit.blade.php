@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Ubah Pelajaran</li>
				</ul>
				<div class="panel panel-custom">
					<div class="panel-heading">
						<h2 class="panel-title">Ubah Pelajaran</h2>
					</div>

					<div class="panel-body">
					{!! Form::model($pelajaran,['url' => route('pelajaran.update',$pelajaran->id), 'method' => 'put' , 'class' => 'form-horizontal']) !!}
					@include('pelajaran._form')
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection