<div class="form-group{{ $errors->has('nis') ? 'has-error' : '' }}">
	{!! Form::label('nis','NIS',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('nis',null,['class'=>'form-control']) !!}
		{!! $errors->first('nis','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::label('name','Nama',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::text('name',null,['class'=>'form-control']) !!}
		{!! $errors->first('name','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jeniskelamin') ? 'has-error' : '' }}">
	{!! Form::label('jeniskelamin','Jenis Kelamin',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		<input type="radio" name="jeniskelamin" value="Laki-Laki">Laki-Laki
  		<input type="radio" name="jeniskelamin" value="Perempuan">Perempuan
		{!! $errors->first('jeniskelamin','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('alamat') ? 'has-error' : '' }}">
	{!! Form::label('alamat','Alamat',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::textarea('alamat',null,['class'=>'form-control']) !!}
		{!! $errors->first('alamat','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('kelas_id') ? 'has-error' : '' }}">
	{!! Form::label('kelas_id','Kelas',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('kelas_id', [""]+App\Kelas::pluck('name','id')->all(),null,['class'=>'form-control js-selectize','placeholder'=>'Pilih Kelas']) !!}
		{!! $errors->first('kelas_id','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jurusan_id') ? 'has-error' : '' }}">
	{!! Form::label('jurusan_id','Kelas',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::select('jurusan_id', [""]+App\Jurusan::pluck('name','id')->all(),null,['class'=>'form-control js-selectize','placeholder'=>'Pilih Jurusan']) !!}
		{!! $errors->first('jurusan_id','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('foto') ? 'has-error' : '' }}">
	{!! Form::label('foto','Foto',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-8">
		{!! Form::file('foto',['class'=>'form-control']) !!}
		@if(isset($siswa) && $siswa->foto)
		<p>
			{!! Html::image(asset('img/'.$siswa->foto),null,['class'=>'img-rounded img-responsive']) !!}
		</p>
		@endif
		{!! $errors->first('foto','<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Simpan', ['class'=>'btn btn-sm btn-primary','type'=>'submit']) !!}
	</div>
</div>