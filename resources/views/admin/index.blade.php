@extends('admin.layouts.admin')

@section('title', 'Admin plugin home')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{route('dofus129.admin.settings')}}" method="POST">
            @csrf
            <div class="mb-3 mt-3">
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="registerInput" @if(setting('dofus129_create_account_on_registration')) checked @endif name="dofus129_create_account_on_registration" aria-describedby="registerInput">
                            <label class="custom-control-label" for="registerInput">Create an in-game account on registration</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="dofus129_customHashalgo">Custom hash algo :</label>
                
                <input name="dofus129_customHashalgo" value="{{ old('dofus129_customHashalgo', setting('dofus129_customHashalgo', '$password;')) }}" type="text" class="form-control" id="dofus129_customHashalgo" aria-describedby="hashHelp">
                <small id="hashHelp" class="form-text text-muted">
                    It's PHP code that will go through the <code>eval()</code> function <br>
                    You have access the to <code>$password</code> variable. <br>
                    Example ( don't forget the <span class="fs-4"><b>;</b></span> ): <br>
                    <ul>
                        <li><code>hash('sha256', $password);</code> --> if your emulator use sha256 hash algo.</li>
                        <li><code>$password;</code> --> if the passwords are plain</li>
                    </ul>
                </small>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <h6>Generate/Dowload certificate to use with in-game commands</h6>
        @if ($certificate)
            <a class="btn btn-success" href="{{route('dofus129.admin.certificate')}}">Download Certificate</a>
            <a class="btn btn-warning" href="{{route('dofus129.admin.test-connection')}}">Test SSL connection to Game Server</a>
            <a class="btn btn-danger" href="{{route('dofus129.admin.generate-certificate')}}">Click re-generate certificate</a>
        @else
            <a class="btn btn-primary" href="{{route('dofus129.admin.generate-certificate')}}">Click generate certificate</a>
        @endif
    </div>
</div>
@endsection
