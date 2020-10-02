@extends('template')

@section('main')
<div id="siswa" class="mt-5">
    <h2>Edit Siswa</h2>
    <!-- Kirim ke route siswa -->
    {!! Form::model($siswa, ['method' => 'PATCH', 'files' => true, 'action' => ['SiswaController@update', $siswa->id]]) !!}
    @include('siswa.form', ['submitButtonText' => 'Update'])
    {!! Form::close() !!}
</div>
@stop

@section('footer')
@include('footer')
@stop