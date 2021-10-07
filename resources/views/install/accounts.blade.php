@extends('install.layout')

@section('content')
<h3>Step 2/ : Accounts Database</h3>
<form action="{{ route('dofus129.install.setupAccountTable') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="ainputTableName" class="col-form-label">Table name :</label>
        
            <input name="dofus129_accounts_tableName"
                value="{{ old('dofus129_accounts_tableName', '') }}" type="text"
                class="form-control @error('dofus129_accounts_tableName') is-invalid @enderror" id="ainputTableName" placeholder="accounts">
        @error('dofus129_accounts_tableName')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        
    </div>
    <div class="form-group">
        <label for="ainputIdCol" class="col-form-label">Id column :</label>

            <input name="dofus129_accounts_primaryKey"
                value="{{ old('dofus129_accounts_primaryKey', '') }}" type="text"
                class="form-control @error('dofus129_accounts_primaryKey') is-invalid @enderror" id="ainputIdCol" placeholder="guid">
        @error('dofus129_accounts_primaryKey')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="ainputUsernameCol" class="col-form-label">Username column :</label>

            <input 
            name="dofus129_accounts_nameCol" 
            value="{{ old('dofus129_accounts_nameCol', '') }}" 
            type="text" class="form-control @error('dofus129_accounts_nameCol') is-invalid @enderror" id="ainputUsernameCol" placeholder="account">
        @error('dofus129_accounts_nameCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="ainputPasswordCol" class="col-form-label">Password column :</label>

            <input name="dofus129_accounts_passwordCol" 
            value="{{ old('dofus129_accounts_passwordCol', '') }}" 
            type="text" class="form-control @error('dofus129_accounts_passwordCol') is-invalid @enderror" id="ainputPasswordCol" placeholder="password">
        @error('dofus129_accounts_passwordCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="ainputPseudoCol" class="col-form-label">Pseudo column :</label>

            <input name="dofus129_accounts_pseudoCol" 
            value="{{ old('dofus129_accounts_pseudoCol', '') }}" 
            type="text" class="form-control @error('dofus129_accounts_pseudoCol') is-invalid @enderror" id="ainputPseudoCol" placeholder="pseudo">
        @error('dofus129_accounts_pseudoCol')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="form-group">
        <label for="ainputQuestionCol" class="col-form-label">Question column :</label>

            <input name="dofus129_accounts_questionCol" 
            value="{{ old('dofus129_accounts_questionCol', '') }}" 
            type="text" class="form-control @error('dofus129_accounts_questionCol') is-invalid @enderror" id="ainputQuestionCol" placeholder="question">
            @error('dofus129_accounts_questionCol')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
    </div>
    <div class="form-group">
        <label for="ainputAnswerCol" class="col-form-label">Answer column :</label>

            <input name="dofus129_accounts_answerCol" 
            value="{{ old('dofus129_accounts_answerCol', '') }}" 
            type="text" class="form-control @error('dofus129_accounts_answerCol') is-invalid @enderror" id="ainputAnswerCol" placeholder="reponse">
            @error('dofus129_accounts_answerCol')
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