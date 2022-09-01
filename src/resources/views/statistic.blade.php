@extends('layouts.app')

@section('title-block')Statistics @endsection

@section('content')
    <h1>Statistics</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">User</th>
            <th scope="col">Source</th>
            <th scope="col">Created At</th>
        </tr>
        </thead>
        <form action="{{ route('statistic-filter') }}" method="POST">
            @csrf
            <tr>
                <td>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="user_id" id="user_id" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="source" id="source" class="form-control">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="created_at" id="created_at" class="form-control">
                    </div>
                </td>
            </tr>
            <tr>
                <button type="submit" class="btn btn-success">Search</button>
            </tr>
        </form>
        <tbody>
        @foreach ($data as $element)
            <tr>
                <th scope="row">{{ $element->id }}</th>
                <td>{{ $element->user_id }} ({{ $element->user->name }})</td>
                <td>{{ $element->source }}</td>
                <td>{{ $element->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
