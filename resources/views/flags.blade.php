@extends('layouts.base')

@section('title', 'List of available flags')

@section('content')
    <div class="row flow-text">
        <div class="col s12 center">
            <h1>Pride flags</h1>
            <div>
                <h5>Our flag command has a lot of flags available to use</h5>
                <h6>If you find a flag that you want added to the bot contact duncte123#1245 on discord</h6>
                <p></p>
            </div>
            <div class="divider"></div>
        </div>
    </div>

    <div class="row">
        @foreach($flags as $flag)
        <div class="col s12 m3">
            <div class="card small">
                <div class="card-image">
                    <img src="/img/flags/{{ $flag['file'] }}" alt="{{ $flag['alt'] }}"/>
                </div>
                <div class="card-content">
                    <p>Command: <br/><code>db!flag {{ $flag['cmd'] }} [@user]</code></p>
                    <p>{{ $flag['alt'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
