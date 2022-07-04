@extends('layouts.app')

@section('title', 'Players')

@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">Login</th>
                <th scope="col">Characters</th>
                <th scope="col">{{ trans('messages.fields.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($relations as $relation)
                <tr>
                    <td>{{$relation->account->{setting('dofus129_accounts_nameCol')} }}</td>
                    <td>
                        @foreach ($relation->characters as $character)
                            <div class="d-inline position-relative mx-2" data-bs-toggle="tooltip" title="{{$character->name}} - Lvl {{$character->level}}">
                                <img src="{{$character->avatar}}" alt="{{$character->name}}" width="32" height="32">
                                <span class="position-absolute top-0 start-100 translate-middle" style="width: 16px;height:16px">
                                    <img src="{{$character->alignement}}" width="16" height="16">
                                </span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a class="mx-1" data-bs-toggle="collapse" href="#collapse-account-{{$loop->index}}" role="button" aria-expanded="false" aria-controls="collapse-account-{{$loop->index}}">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr class="collapse" id="collapse-account-{{$loop->index}}" >
                    <td colspan="3">
                        <div class="w-100 px-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <h2 class="card-title">
                                                {{ trans('messages.profile.change_password') }}
                                            </h2>
                    
                                            <form action="{{route('dofus129.accounts.update-password', $relation->account->{setting('dofus129_accounts_primaryKey')})}}" method="POST">
                                                @csrf
                    
                                                <div class="mb-3">
                                                    <label class="form-label" for="passwordInput">{{ trans('auth.password') }}</label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" name="password" required>
                    
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                    
                                                <div class="mb-3">
                                                    <label class="form-label" for="confirmPasswordInput">{{ trans('auth.confirm_password') }}</label>
                                                    <input type="password" class="form-control" id="confirmPasswordInput" name="password_confirmation" required>
                                                </div>
                    
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('messages.actions.update') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">No accounts</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header">Create an account</div>
            <div class="card-body">
                <form action="{{ route('dofus129.accounts.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="login" class="form-label">{{trans('auth.name')}}</label>
                        <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" id="login">
                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ trans('auth.password') }}</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ trans('auth.confirm_password') }}</label>
                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{trans('messages.actions.create')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection