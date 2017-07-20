@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Ubah Jurusan</li>
				</ul>
				<div class="panel panel-custom">
					<div class="panel-heading">
						<h2 class="panel-title">Ubah Jurusan</h2>
					</div>

					<div class="panel-body">
					{!! Form::model($jurusan,['url' => route('jurusan.update',$jurusan->id), 'method' => 'put' , 'class' => 'form-horizontal']) !!}
					@include('jurusan._form')
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection