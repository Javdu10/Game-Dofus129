@extends('admin.layouts.admin')

@section('title', 'Admin plugin home')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('dofus129.admin.settings')}}" method="POST">
            @csrf
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Table of accounts of your emulator
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            @include('dofus129::admin.partials.accounts-table')
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Table of characters of your emulator
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            @include('dofus129::admin.partials.characters-table')
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Database connection (if your website and game server are not on the same machine)
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            @include('dofus129::admin.partials.database')
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="registerInput" @if(setting('dofus129_create_account_on_registration')) checked @endif name="dofus129_create_account_on_registration" aria-describedby="registerInput">
                            <label class="custom-control-label" for="registerInput">Create an in-game account on registration</label>
                        </div>
            
                        <small id="registerInput" class="form-text">Make sure to fill correctly the table of accounts first</small>
                    </div>
                    <div class="col">
                            <a class="btn btn-primary text-white" onclick="this.preventDefault;document.querySelector('#account_creation_form').submit();" aria-describedby="account_creation">Test account creation</a>
                            <small id="account_creation" class="form-text">Test only after saving your settings!</small>
                    </div>
                </div>
                
            </div>

            <div class="form-group row">
                <label for="dofus129_customHashalgo" class="col-sm-2 col-form-label">Custom hash algo :</label>
                <div class="col-sm-10">
                    <input name="dofus129_customHashalgo" value="{{ old('dofus129_customHashalgo', setting('dofus129_customHashalgo')) }}" type="text" class="form-control" id="dofus129_customHashalgo" placeholder="pseudo" aria-describedby="hashHelp">
                    <small id="hashHelp" class="form-text text-muted">You have access the to <code>$password</code> variable.</small>
                </div>
                
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form id="account_creation_form" action="{{route('dofus129.admin.test_account_creation')}}" method="post">@csrf</form>
    </div>
</div>
@endsection
