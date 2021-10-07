@extends('install.layout')

@section('content')
<h3>Step 3/ : Character Database</h3>
<form action="{{ route('dofus129.install.setupCharacterTable') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="ainputTableName">Database name :</label>

        <input name="dofus129_characters_databaseName"
            value="{{ old('dofus129_characters_databaseName', setting('dofus129_characters_databaseName')) }}"
            type="text" class="form-control @error('dofus129_characters_databaseName') is-invalid @enderror" id="ainputTableName" placeholder="accounts">
        @error('dofus129_characters_databaseName')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputTableName">Table name :</label>

        <input name="dofus129_characters_tableName"
            value="{{ old('dofus129_characters_tableName', setting('dofus129_characters_tableName')) }}" type="text"
            class="form-control @error('dofus129_characters_tableName') is-invalid @enderror" id="inputTableName" placeholder="characters">
        @error('dofus129_characters_tableName')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputIdCol">Id column :</label>
        
            <input name="dofus129_characters_primaryKey"
                value="{{ old('dofus129_characters_primaryKey', setting('dofus129_characters_primaryKey')) }}"
                type="text" class="form-control @error('dofus129_characters_primaryKey') is-invalid @enderror" id="inputIdCol" placeholder="id">
        @error('dofus129_characters_primaryKey')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputAccountIdCol">AccountId foreign key column :</label>
        
            <input name="dofus129_accounts_foreignKey"
                value="{{ old('dofus129_accounts_foreignKey', setting('dofus129_accounts_foreignKey')) }}" type="text"
                class="form-control @error('dofus129_accounts_foreignKey') is-invalid @enderror" id="inputAccountIdCol" placeholder="account_id">
        @error('dofus129_accounts_foreignKey')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputUsernameCol">Name column :</label>
        
            <input name="dofus129_characters_nameCol"
                value="{{ old('dofus129_characters_nameCol', setting('dofus129_characters_nameCol')) }}" type="text"
                class="form-control @error('dofus129_characters_nameCol') is-invalid @enderror" id="inputUsernameCol" placeholder="name">
        @error('dofus129_characters_nameCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="dofus129_characters_sexeCol">Sexe column :</label>
        
            <input name="dofus129_characters_sexeCol"
                value="{{ old('dofus129_characters_sexeCol', setting('dofus129_characters_sexeCol')) }}" type="text"
                class="form-control @error('dofus129_characters_sexeCol') is-invalid @enderror" id="dofus129_characters_sexeCol" placeholder="sexe">
        @error('dofus129_characters_sexeCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="dofus129_characters_classCol">Class column :</label>
        
            <input name="dofus129_characters_classCol"
                value="{{ old('dofus129_characters_classCol', setting('dofus129_characters_classCol')) }}" type="text"
                class="form-control @error('dofus129_characters_classCol') is-invalid @enderror" id="dofus129_characters_classCol" placeholder="class">
        @error('dofus129_characters_classCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputLevelCol">Level column :</label>
        
            <input name="dofus129_characters_levelCol"
                value="{{ old('dofus129_characters_levelCol', setting('dofus129_characters_levelCol')) }}" type="text"
                class="form-control @error('dofus129_characters_levelCol') is-invalid @enderror" id="inputLevelCol" placeholder="level">
            @error('dofus129_characters_levelCol')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        
    </div>
    <div class="form-group">
        <label for="inputExperienceCol">Experience column :</label>
        
            <input name="dofus129_characters_experienceCol"
                value="{{ old('dofus129_characters_experienceCol', setting('dofus129_characters_experienceCol')) }}"
                type="text" class="form-control @error('dofus129_characters_experienceCol') is-invalid @enderror" id="inputExperienceCol" placeholder="experience">
        @error('dofus129_characters_experienceCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="dofus129_characters_alignementCol">Alignement column :</label>
        
            <input name="dofus129_characters_alignementCol"
                value="{{ old('dofus129_characters_alignementCol', setting('dofus129_characters_alignementCol')) }}"
                type="text" class="form-control @error('dofus129_characters_alignementCol') is-invalid @enderror" id="dofus129_characters_alignementCol" placeholder="alignement">
        @error('dofus129_characters_alignementCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="dofus129_characters_honorCol">Honor Experience column :</label>
        
            <input name="dofus129_characters_honorCol"
                value="{{ old('dofus129_characters_honorCol', setting('dofus129_characters_honorCol')) }}" type="text"
                class="form-control @error('dofus129_characters_honorCol') is-invalid @enderror" id="dofus129_characters_honorCol" placeholder="honor">
        @error('dofus129_characters_honorCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            {{ trans('messages.actions.continue') }} <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>
@endsection
