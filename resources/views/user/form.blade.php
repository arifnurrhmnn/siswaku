@if (isset($user))
    {!! Form::hidden('id', $user->id) !!}
@endif

@if ($errors->any())
    <div class="form-group {{ $errors->has('name') ? 'has-error' : 'has-success' }}">
    @else
        <div class="form-group">
@endif
{!! Form::label('name', 'NAMA:', ['class' => 'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
@if ($errors->has('name'))
    <span class="help-block">{{ $errors->first('name') }}</span>
@endif
</div>


@if ($errors->any())
    <div class="form-group {{ $errors->has('email') ? 'has-error' : 'has-success' }}">
    @else
        <div class="form-group">
@endif
{!! Form::label('email', 'EMAIL:', ['class' => 'control-label']) !!}
{!! Form::text('email', null, ['class' => 'form-control']) !!}
@if ($errors->has('email'))
    <span class="help-block">{{ $errors->first('email') }}</span>
@endif
</div>

@if ($errors->any())
    <div class="form-group {{ $errors->has('level') ? 'has-error' : 'has-success' }}">
    @else
        <div class="form-group">
@endif
{!! Form::label('level', 'LEVEL:', ['class' => 'control-label']) !!}
<div class="radio">
    <label>{!! Form::radio('level', 'operator') !!} Operator</label>
</div>
<div class="radio">
    <label>{!! Form::radio('level', 'admin') !!} Administrator</label>
</div>
@if ($errors->has('jenis_kelamin'))
    <span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
@endif
</div>

@if ($errors->any())
    <div class="form-group {{ $errors->has('password') ? 'has-error' : 'has-success' }}">
    @else
        <div class="form-group">
@endif
{!! Form::label('password', 'PASSWORD:', ['class' => 'control-label']) !!}
{!! Form::password('password', ['class' => 'form-control']) !!}
@if ($errors->has('password'))
    <span class="help-block">{{ $errors->first('password') }}</span>
@endif
</div>

@if ($errors->any())
    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : 'has-success' }}">
    @else
        <div class="form-group">
@endif
{!! Form::label('password_confirmation', 'PASSWORD CONFIRMATION:', ['class' => 'control-label']) !!}
{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
@if ($errors->has('password_confirmation'))
    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
@endif
</div>

<div class="form-group mt-5">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
