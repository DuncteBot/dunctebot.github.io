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
        <div class="col s12 m4">
            <div class="center delay-1 promo animated fadeInUp">
                <i class="material-icons">flash_on</i>
                <p class="promo-caption">Super Fast</p>
                <p class="light center">This bot has really fast response timing on top of having a lot of unique
                    features</p>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="center delay-2 promo animated fadeInUp">
                <i class="material-icons">speaker_group</i>
                <p class="promo-caption">High Quality Music</p>
                <p class="light center">On top of us supporting playing music from Spotify, we also provide the music
                    from our high quality music servers</p>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="center delay-3 promo animated fadeInUp">
                <i class="material-icons">settings</i>
                <p class="promo-caption">Very Customizable</p>
                <p class="light center">You can customize almost everything on this bot, from the embed colors
                    to custom commands</p>
            </div>
        </div>
    </section>

    <section class="row oh">
        <div class="divider"></div>
        <div class="center">
            <h3>Invite the bot today</h3>
            <a class="waves-effect waves-light btn-large blue darken-4 bg" href="{{ $botInvite }}" target="_blank">Click Here</a>
        </div>
    </section>
@endsection
