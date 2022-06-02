@extends('install.layout')

@section('content')

<h3>Step 1/ : Accounts Database</h3>
<form action="{{ route('dofus129.install.credentialAccountDatabase') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="type" class="form-label">{{ trans('install.database.type') }}</label>
        <select class="custom-select" id="type" name="dofus129_database_driver">
            @foreach($databaseDrivers as $dbId => $dbName)
                <option value="{{ $dbId }}" @if($dbId === $credentials['driver']) selected @endif>{{ $dbName }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="ainputTableName" class="form-label">Database name :</label>
        
            <input name="dofus129_accounts_databaseName"
                value="{{ old('dofus129_accounts_databaseName', '') }}" type="text"
                class="form-control @error('dofus129_accounts_databaseName') is-invalid @enderror" id="ainputTableName" placeholder="accounts">
                @error('dofus129_accounts_databaseName')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <small class="form-text text-muted">
                    The database that holds the account informations
                </small>
                
                
    </div>
    
    <div class="form-row">
        <div class="mb-3 col-md-9">
            <label for="dofus129_database_host" class="form-label">{{ trans('install.database.host') }}</label>
            <input name="dofus129_database_host" type="text" class="form-control @error('dofus129_database_host') is-invalid @enderror" id="dofus129_database_host" value="{{ old('dofus129_database_host', $credentials['host']) }}">

            @error('dofus129_database_host')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-3 col-md-3">
            <label for="dofus129_database_port" class="form-label">{{ trans('install.database.port') }}</label>
            <input name="dofus129_database_port" type="number" class="form-control @error('dofus129_database_port') is-invalid @enderror" id="dofus129_database_port" value="{{ old('dofus129_database_port', $credentials['port']) }}">

            @error('dofus129_database_port')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="dofus129_database_username" class="form-label">{{ trans('install.database.user') }}</label>
        <input name="dofus129_database_username" type="text" class="form-control @error('dofus129_database_username') is-invalid @enderror" id="dofus129_database_username" value="{{ old('dofus129_database_username', $credentials['username']) }}">

        @error('dofus129_database_username')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="dofus129_database_password" class="form-label">{{ trans('install.database.password') }}</label>
        <input name="dofus129_database_password" type="password" class="form-control" id="dofus129_database_password" value="{{ old('dofus129_database_password', $credentials['password']) }}">
        
        @error('dofus129_database_password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary rounded-pill mx-1">
            {{ trans('messages.actions.continue') }} <i class="bi bi-arrow-right"></i>
        </button>
    </div>
</form>
@endsection