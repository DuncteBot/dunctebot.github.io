@extends('layouts.base')

@section('title', 'Home')

@section('content')
    <section class="row flow-text oh">
        <div class="col m6 s12">
            <h1 class="bounceInLeft animated">DuncteBot</h1>
            <div>
                <h5 class="animated bounceInUp">A multipurpose moderation bot for discord</h5>
                <div class="divider animated bounceInDown"></div>
            </div>
        </div>
    </section>

    <section class="row flow-text oh">
        @for($i = 0; $i < count($features); $i++)
            <div class="col s12 m4">
                <div class="center delay-{!! $i + 1 !!} promo animated fadeInUp">
                    <i class="material-icons">{!! $features[$i]->icon !!}</i>
                    <p class="promo-caption">{!! $features[$i]->caption !!}</p>
                    <p class="light center">{!! $features[$i]->description !!}</p>
                </div>
            </div>
        @endfor
    </section>

    <div class="row">
        <div class="divider"></div>
    </div>

    <section class="row oh">
        <div class="center">
            <h3>Invite the bot today</h3>
            <a class="waves-effect waves-light btn-large blue darken-4 bg" href="{!! $botInvite !!}" target="_blank">Click Here</a>
        </div>
    </section>

    <div class="row">
        <div class="divider"></div>
    </div>

    <section class="row oh">
        <div class="center">
            <h5>Random command: {!! $prefix !!}{!! $randomCmd !!}</h5>
            <p>Why don't you give that command a try</p>
            <p>Or <a href="/commands">click here</a> to view all commands</p>
        </div>
    </section>
@endsection
