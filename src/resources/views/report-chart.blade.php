@extends('layouts.app')

@section('title-block')
    Charts
@endsection

@section('content')
    <h1 class="text-center">Charts</h1>

    <h2>Click Download Activity</h2>
    <div id="app">{!! $chartClickDownload->container() !!}</div>
    <h2>Click Buy Activity</h2>
    <div id="app">{!! $chartClickBuy->container() !!}</div>
    <h2>View Documents</h2>
    <div id="app">{!! $chartViewDocuments->container() !!}</div>
    <h2>View Cowshed</h2>
    <div id="app">{!! $chartViewCowshed->container() !!}</div>

    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
    {!! $chartClickDownload->script() !!}
    {!! $chartClickBuy->script() !!}
    {!! $chartViewDocuments->script() !!}
    {!! $chartViewCowshed->script() !!}

@endsection
