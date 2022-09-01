@extends('layouts.app')

@section('title-block')
    Table
@endsection

@section('content')
    <h1 class="text-center">Table</h1>
    <br/>
    <br/>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Count Page Cowshed</th>
            <th scope="col">Count Page Documents</th>
            <th scope="col">Count Click Download</th>
            <th scope="col">Count Click Buy A Cow</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $element)
            <tr>
                <td>{{ $element['date'] }}</td>
                <td>{{ $element['/order/index'] }}</td>
                <td>{{ $element['/document/index'] }}</td>
                <td>{{ $element['/document/download'] }}</td>
                <td>{{ $element['/order/send'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
