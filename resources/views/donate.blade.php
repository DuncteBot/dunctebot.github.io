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
            <p>For the past 4 years we've been working on DuncteBot and creating awesome features for the users.
                We want to keep the bot free and without ads on the website because just like you, we dislike ads.
                Donations are our only source of income and help keep the bot online and free.
            </p>
        </div>
        <div class="row center">
            <a href="" class="btn-large waves-effect waves-light" target="_blank">Patreon</a>
            <a href="" class="btn-large waves-effect waves-light" target="_blank">Paypal</a>
        </div>
    </section>

    <section>
        <div class="flow-text row">
            <p>Our donators</p>
        </div>

        <div class="row">
            <table class="striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Donation</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>Alvin</td>
                    <td>Eclair</td>
                    <td>$0.87</td>
                </tr>
                <tr>
                    <td>Alan</td>
                    <td>Jellybean</td>
                    <td>$3.76</td>
                </tr>
                <tr>
                    <td>Jonathan</td>
                    <td>Lollipop</td>
                    <td>$7.00</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
