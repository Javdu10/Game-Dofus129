<div class="form-group row">
    <label for="ainputTableName" class="col-sm-2 col-form-label">Database name :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_databaseName"
            value="{{ old('dofus129_accounts_databaseName', setting('dofus129_accounts_databaseName')) }}" type="text"
            class="form-control" id="ainputTableName" placeholder="accounts">
    </div>
</div>
<div class="form-group row">
    <label for="ainputTableName" class="col-sm-2 col-form-label">Table name :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_tableName"
            value="{{ old('dofus129_accounts_tableName', setting('dofus129_accounts_tableName')) }}" type="text"
            class="form-control" id="ainputTableName" placeholder="accounts">
    </div>
</div>
<div class="form-group row">
    <label for="ainputIdCol" class="col-sm-2 col-form-label">Id column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_primaryKey"
            value="{{ old('dofus129_accounts_primaryKey', setting('dofus129_accounts_primaryKey')) }}" type="text"
            class="form-control" id="ainputIdCol" placeholder="id">
    </div>
</div>
<div class="form-group row">
    <label for="ainputUsernameCol" class="col-sm-2 col-form-label">Username column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_nameCol" value="{{ old('dofus129_accounts_nameCol', setting('dofus129_accounts_nameCol')) }}" type="text" class="form-control" id="ainputUsernameCol" placeholder="username">
    </div>
</div>
<div class="form-group row">
    <label for="ainputPasswordCol" class="col-sm-2 col-form-label">Password column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_passwordCol" value="{{ old('dofus129_accounts_passwordCol', setting('dofus129_accounts_passwordCol')) }}" type="text" class="form-control" id="ainputPasswordCol" placeholder="password">
    </div>
</div>
<div class="form-group row">
    <label for="ainputPseudoCol" class="col-sm-2 col-form-label">Pseudo column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_pseudoCol" value="{{ old('dofus129_accounts_pseudoCol', setting('dofus129_accounts_pseudoCol')) }}" type="text" class="form-control" id="ainputPseudoCol" placeholder="pseudo">
    </div>
</div>
<div class="form-group row">
    <label for="ainputQuestionCol" class="col-sm-2 col-form-label">Question column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_questionCol" value="{{ old('dofus129_accounts_questionCol', setting('dofus129_accounts_questionCol')) }}" type="text" class="form-control" id="ainputQuestionCol" placeholder="question">
    </div>
</div>
<div class="form-group row">
    <label for="ainputAnswerCol" class="col-sm-2 col-form-label">Answer column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_answerCol" value="{{ old('dofus129_accounts_answerCol', setting('dofus129_accounts_answerCol')) }}" type="text" class="form-control" id="ainputAnswerCol" placeholder="answer">
    </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
