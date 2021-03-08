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
        <input type="text" class="form-control" id="inputUsernameCol" placeholder="name">
    </div>
</div>
<div class="form-group row">
    <label for="inputLevelCol" class="col-sm-2 col-form-label">Level column :</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="inputLevelCol" placeholder="level">
    </div>
</div>
<div class="form-group row">
    <label for="inputExperienceCol" class="col-sm-2 col-form-label">Experience column :</label>
    <div class="col-sm-10">
        <input name="dofus129_accounts_experienceCol" value="{{ old('dofus129_accounts_experienceCol', setting('dofus129_accounts_experienceCol')) }}" type="text" class="form-control" id="inputExperienceCol" placeholder="experience">
    </div>
</div>
<div class="form-group row">
    <label for="inputHonorExperienceCol" class="col-sm-2 col-form-label">Honor Experience column :</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="inputHonorExperienceCol" placeholder="honor">
    </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
