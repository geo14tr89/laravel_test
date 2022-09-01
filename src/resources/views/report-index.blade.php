@extends('layouts.app')

@section('title-block')
    Reports
@endsection

@section('content')
    <h1 class="text-center">Reports</h1>
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-2 d-flex justify-content-center">
            <a href="{{ route('report-chart') }}"><button type="submit" class="btn btn-success">Show Chart</button></a>
        </div>
        <div class="col-md-2 d-flex justify-content-center">
            <a href="{{ route('report-table') }}"><button type="submit" class="btn btn-success">Show Table</button></a>
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection
