<div class="form-group row">
    <label for="ainputTableName" class="col-sm-2 col-form-label">Database name :</label>
    <div class="col-sm-10">
        <input name="dofus129_characters_databaseName"
            value="{{ old('dofus129_characters_databaseName', setting('dofus129_characters_databaseName')) }}" type="text"
            class="form-control" id="ainputTableName" placeholder="accounts">
    </div>
</div>
<div class="form-group row">
    <label for="inputTableName" class="col-sm-2 col-form-label">Table name :</label>
    <div class="col-sm-10">
        <input name="dofus129_characters_tableName"
            value="{{ old('dofus129_characters_tableName', setting('dofus129_characters_tableName')) }}" type="text"
            class="form-control" id="inputTableName" placeholder="characters">
    </div>
</div>
<div class="form-group row">
    <label for="inputIdCol" class="col-sm-2 col-form-label">Id column :</label>
    <div class="col-sm-10">
        <input name="dofus129_characters_primaryKey"
            value="{{ old('dofus129_characters_primaryKey', setting('dofus129_characters_primaryKey')) }}" type="text"
            class="form-control" id="inputIdCol" placeholder="id">
    </div>
</div>
<div class="form-group row">
    <label for="inputAccountIdCol" class="col-sm-2 col-form-label">AccountId foreign key column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_foreignKey" value="{{ old('dofus129_accounts_foreignKey', setting('dofus129_accounts_foreignKey')) }}" type="text" class="form-control" id="inputAccountIdCol" placeholder="account_id">
    </div>
</div>
<div class="form-group row">
    <label for="inputUsernameCol" class="col-sm-2 col-form-label">Name column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_nameCol" value="{{ old('dofus129_accounts_nameCol', setting('dofus129_accounts_nameCol')) }}" type="text" class="form-control" id="inputUsernameCol" placeholder="name">
    </div>
</div>
<div class="form-group row">
    <label for="dofus129_accounts_sexeCol" class="col-sm-2 col-form-label">Sexe column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_sexeCol" value="{{ old('dofus129_accounts_sexeCol', setting('dofus129_accounts_sexeCol')) }}" type="text" class="form-control" id="dofus129_accounts_sexeCol" placeholder="sexe">
    </div>
</div>
<div class="form-group row">
    <label for="dofus129_accounts_classCol" class="col-sm-2 col-form-label">Class column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_classCol" value="{{ old('dofus129_accounts_classCol', setting('dofus129_accounts_classCol')) }}" type="text" class="form-control" id="dofus129_accounts_classCol" placeholder="class">
    </div>
</div>
<div class="form-group row">
    <label for="inputLevelCol" class="col-sm-2 col-form-label">Level column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_levelCol" value="{{ old('dofus129_accounts_levelCol', setting('dofus129_accounts_levelCol')) }}" type="text" class="form-control" id="inputLevelCol" placeholder="level">
    </div>
</div>
<div class="form-group row">
    <label for="inputExperienceCol" class="col-sm-2 col-form-label">Experience column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_experienceCol" value="{{ old('dofus129_accounts_experienceCol', setting('dofus129_accounts_experienceCol')) }}" type="text" class="form-control" id="inputExperienceCol" placeholder="experience">
    </div>
</div>
<div class="form-group row">
    <label for="dofus129_accounts_alignementCol" class="col-sm-2 col-form-label">Alignement column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_alignementCol" value="{{ old('dofus129_accounts_alignementCol', setting('dofus129_accounts_alignementCol')) }}" type="text" class="form-control" id="dofus129_accounts_alignementCol" placeholder="alignement">
    </div>
</div>
<div class="form-group row">
    <label for="dofus129_accounts_honorCol" class="col-sm-2 col-form-label">Honor Experience column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_honorCol" value="{{ old('dofus129_accounts_honorCol', setting('dofus129_accounts_honorCol')) }}" type="text" class="form-control" id="dofus129_accounts_honorCol" placeholder="honor">
    </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
