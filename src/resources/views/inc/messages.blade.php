@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (isset($success))
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif

@if (isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif


