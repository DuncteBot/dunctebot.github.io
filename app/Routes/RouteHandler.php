<?php
/**
 *      Copyright 2017-2020 Duncan "duncte123" Sterken
 *
 *      Licensed under the Apache License, Version 2.0 (the "License");
 *      you may not use this file except in compliance with the License.
 *      You may obtain a copy of the License at
 *
 *          http://www.apache.org/licenses/LICENSE-2.0
 *
 *      Unless required by applicable law or agreed to in writing, software
 *      distributed under the License is distributed on an "AS IS" BASIS,
 *      WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *      See the License for the specific language governing permissions and
 *      limitations under the License.
 */

namespace App\Routes;

use App\View\BladeLoader;

class RouteHandler {

    public function home(BladeLoader $blade)
    {
        $commands = \json_decode(\file_get_contents(__DIR__ . '/../../resources/commands.json'));
        $rand = \array_rand($commands);

        $features = \json_decode(\file_get_contents(__DIR__ . '/../../resources/features.json'));
        $randomFeatures = \array_rand($features, 3);
        $mappedFeatures = \array_map(function($n) use ($features) { return $features[$n]; }, $randomFeatures);
        \shuffle($mappedFeatures);

        return $blade->view('home', [
            'randomCmd' => $commands[$rand]->name,
            'features' => $mappedFeatures,
        ]);
    }

    public function commands(BladeLoader $blade)
    {
        return $blade->view('commands');
    }

    public function suggest(BladeLoader $blade)
    {
        any_empty("hello", 'world', 'test');

        return $blade->view('suggest');
    }

    public function submitSuggest()
    {
        $in = file_get_contents('php://input');

        if (!$in) {
            http_response_code(400);
            return json_response([
                'status' => 'failure',
                'message' => 'invalid_json',
                'code' => '400',
            ]);
        }

        $p = json_decode($in, true);

        if (
            !isset($p['name'], $p['sug'], $p['g-recaptcha-response']) ||
            any_empty($p['name'], $p['sug'], $p['g-recaptcha-response'])
        ) {
            http_response_code(400);
            return json_response([
                'status' => 'failure',
                'message' => 'missing_input',
                'code' => '400',
            ]);
        }

        if (!verify_captcha($p['g-recaptcha-response'])) {
            http_response_code(400);
            return json_response([
                'status' => 'failure',
                'message' => 'captcha_failed',
                'code' => '400',
            ]);
        }

        $extraDesc = '';

        if (isset($p['desc']) && !empty($p['desc'])) {
            $extraDesc = "{$p['desc']}\n\n";
        }

        $description = "{$extraDesc}Suggested by: {$p['name']}\nSuggested from website";

        $trello = add_trello_card($p['sug'], $description);

        if ($trello === null) {
            http_response_code(400);
            return json_response([
                'status' => 'failure',
                'message' => 'trello_failed',
                'code' => '400',
            ]);
        }

        http_response_code(200);
        return json_response([
            'status' => 'success',
            'trello_url' => $trello->shortUrl,
            'code' => '200',
        ]);
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

    public function radiostreams(BladeLoader $blade)
    {
        return $blade->view('radiostreams');
    }

    public function issueGenerator(BladeLoader $blade)
    {
        return $blade->view('issuegenerator');
    }
}
