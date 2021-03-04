@extends('layouts.base')

@section('title', 'Donate to DuncteBot')

@push('styles')
    <style>
        a.btn-large {
            width: 260px;
            height: 70px;
            margin: 4px;
            padding: 0;
            line-height: 70px;
            font-size: 18px;
            font-weight: 400;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="flow-text">
            <h1>Donate</h1>
            <p>For the past {!! $years !!} years we've been working on DuncteBot and creating awesome features for the users.
                We want to keep the bot free and without ads on the website because just like you, we dislike ads.
                Donations are our only source of income and help keep the bot online and free.
            </p>
        </div>
        <div class="row center">
            <a href="https://patreon.com/DuncteBot" class="btn-large waves-effect waves-light" target="_blank">Patreon</a>
            <a href="https://paypal.me/duncte123" class="btn-large waves-effect waves-light" target="_blank">Paypal</a>
        </div>
    </section>

    <div class="row">
        <div class="divider"></div>
    </div>

    <section>
        <div class="flow-text row">
            <p>Our Patrons</p>
            <p>Thanks to our patrons we can continue to improve the bot</p>
        </div>

        <div class="row">
            <div class="col offset-s3 s6">
                <table class="striped centered z-depth-2">
                    <tbody>
                    @foreach($patrons as $patron)
                        <tr>
                            <td>{{ $patron }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
