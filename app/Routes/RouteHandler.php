<?php
/**
 *    Copyright 2017-2019 Duncan "duncte123" Sterken
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */

namespace App\Routes;

use App\View\BladeLoader;

class RouteHandler {

    public function home(BladeLoader $blade)
    {
        $commands = \json_decode(\file_get_contents(__DIR__ . '/../../resources/commands.json'));
        $rand = \array_rand($commands);

        return $blade->view('home', [
            'randomCmd' => $commands[$rand]->name,
        ]);
    }

    public function commands(BladeLoader $blade)
    {
        return $blade->view('commands');
    }

    public function suggest(BladeLoader $blade)
    {
        return $blade->view('suggest');
    }

    public function donate(BladeLoader $blade)
    {
        return $blade->view('donate');
    }


    public function commandsBotlist(BladeLoader $blade)
    {
        return $blade->view('commands_botlist');
    }

    public function liveServerCount(BladeLoader $blade)
    {
        return $blade->view('livecount');
    }

    public function issueGenerator(BladeLoader $blade)
    {
        return $blade->view('issuegenerator');
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
