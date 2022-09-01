@extends('layouts.app')

@section('title-block')Login @endsection

@section('content')
    <h1>Login</h1>

    <form action="{{ route('user/login') }}" method="post">
        @csrf
        <div class="form-group form-group-padding">
            <label for="name">Enter your name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control">
        </div>
        <div class="form-group form-group-padding">
            <label for="password">Enter your password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Send</button>
    </form>
@endsection
