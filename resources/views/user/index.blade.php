@extends('template')

@section('main')
<div id="user" class="mt-4">
    <h2>User</h2>

    @include('_partial.flash_message')

    @if (count($user_list) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($user_list as $user) : ?>
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                    <td>
                        <div class="box-button">
                            {{ link_to('user/' . $user->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
                        </div>
                        <div class="box-button">
                            {!! Form::open(['method'=>'DELETE', 'action' => ['UserController@destroy', $user->id]] ) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    @else
    <p>Tidak ada data User</p>
    @endif

    <div class="tombol-nav">
        <div>
            <a href="{{ url('user/create') }}" class="btn btn-primary">Tambah User</a>
        </div>
    </div>
</div>
@stop

@section('footer')
    @include('footer')
@stop