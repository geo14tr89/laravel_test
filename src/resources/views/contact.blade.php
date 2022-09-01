@extends('layouts.app')

@section('title-block')Contacts @endsection

@section('content')
    <h1>Contacts</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact-form') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Enter your name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Enter your email</label>
            <input type="text" name="email" id="email" placeholder="Enter your email" class="form-control">
        </div>

        <div class="form-group">
            <label for="subject">Message subject</label>
            <input type="text" name="subject" id="subject" placeholder="Message subject" class="form-control">
        </div>

        <div class="form-group">
            <label for="message">Enter your message</label>
            <textarea name="message" id="message" placeholder="Enter your message" class="form-control">
            </textarea>
        </div>

        <button type="submit" class="btn btn-success">Send</button>
    </form>
@endsection


