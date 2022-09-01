@extends('layouts.app')

@section('title-block')Download some document @endsection

@section('content')
    <h1>Download some document</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="/document/download"><button type="submit" class="btn btn-success" id="submit">Download</button></a>
@endsection
