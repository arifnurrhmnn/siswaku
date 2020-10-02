@extends('template')

@section('main')
<div id="siswa" class="mt-5">
    <h2>Tambah Siswa</h2>
    <!-- Kirim ke route siswa -->
    {!! Form::open(['url' => 'siswa', 'files' => true]) !!}
    @include('siswa.form', ['submitButtonText' => 'Simpan'])
    {!! Form::close() !!}
</div>
@stop

@section('footer')
@include('footer')
@stop