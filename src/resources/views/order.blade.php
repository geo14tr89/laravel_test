@extends('layouts.app')

@section('title-block')Buy a cow @endsection

@section('content')
    <h1>Buy a cow</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('send') }}" method="post" id="sendForm">
        @csrf
        <input type="hidden" name="count_click" value="1">
        @if (session('success'))
            <script>
                $('form').on('submit', function (e) {
                    $('button[type=submit], input[type=submit]', $(this)).blur().addClass('disabled is-submited');
                });

                $(document).on('click', 'button[type=submit].is-submited, input[type=submit].is-submited', function(e) {
                    e.preventDefault();
                });
            </script>
        @else
            <button type="submit" class="btn btn-success" id="submit">Send</button>
        @endif
    </form>
@endsection
