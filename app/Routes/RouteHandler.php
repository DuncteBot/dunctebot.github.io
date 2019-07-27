<?php

namespace App\Routes;

use App\View\BladeLoader;

class RouteHandler {

    public function home(BladeLoader $blade)
    {
        return $blade->view('home');
    }

    public function commands(BladeLoader $blade)
    {
        return $blade->view('commands');
    }

    public function suggest(BladeLoader $blade)
    {
        return $blade->view('suggest');
    }

    public function commandsBotlist(BladeLoader $blade)
    {
        return $blade->view('commands_botlist');
    }

    public function flags(BladeLoader $blade)
    {
        return $blade->view('flags', [
            'flags' => [
                [
                    'file' => 'Agender_pride_flag.svg.png',
                    'alt' => 'Agender pride flag',
                    'cmd' => 'agender',
                ],
                [
                    'file' => 'Aromantic_Flag.svg.png',
                    'alt' => 'Aromantic pride flag',
                    'cmd' => 'aromantic',
                ],
                [
                    'file' => 'asexual_flag.png',
                    'alt' => 'Asexual pride flag',
                    'cmd' => 'asexual',
                ],
                [
                    'file' => 'bear_brotherhood_flag.png',
                    'alt' => 'Bear Brotherhood pride flag',
                    'cmd' => 'bear',
                ],
                [
                    'file' => 'bi_flag.png',
                    'alt' => 'Bisexuality pride flag',
                    'cmd' => 'bi',
                ],
                [
                    'file' => 'Demigirl.png',
                    'alt' => 'Demigirl flag',
                    'cmd' => 'demigirl',
                ],
                [
                    'file' => 'gay_flag.png',
                    'alt' => 'Gay pride flag',
                    'cmd' => 'gay',
                ],
                [
                    'file' => 'Genderfluidity_Pride-Flag.svg.png',
                    'alt' => 'Genderfluidity pride flag',
                    'cmd' => 'genderfluid',
                ],
                [
                    'file' => 'lesbian_pride_flag.png',
                    'alt' => 'Lesbian pride flag',
                    'cmd' => 'lesbian',
                ],
                [
                    'file' => 'Nonbinary_flag.svg.png',
                    'alt' => 'Nonbinary pride flag',
                    'cmd' => 'nonbinary',
                ],
                [
                    'file' => 'Pansexuality_flag.svg.png',
                    'alt' => 'Pansexuality pride flag',
                    'cmd' => 'pan',
                ],
                [
                    'file' => 'transgender_pride_flag.png',
                    'alt' => 'Transgender pride flag',
                    'cmd' => 'transgender',
                ],
            ],
        ]);
    }
}
