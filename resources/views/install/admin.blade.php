@extends('install.layout')

@section('content')
<h3>Step 4/ : Admin account</h3>
<form action="{{ route('dofus129.install.setupAdminAccount') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">{{ trans('install.game.user.name') }}</label>
    
        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" autocomplete="name" required value="{{ old('name', '') }}">
    
        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="email">{{ trans('install.game.user.email') }}</label>
    
        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" autocomplete="email" required value="{{ old('email', '') }}">
    
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="password">{{ trans('install.game.user.password') }}</label>
    
        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" required>
    
        @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="password-confirm">{{ trans('install.game.user.password_confirm') }}</label>
    
        <input name="password_confirmation" id="password-confirm" type="password" class="form-control" autocomplete="new-password" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            {{ trans('messages.actions.continue') }} <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>

@endsection