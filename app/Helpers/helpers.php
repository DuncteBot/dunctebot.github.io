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

if (!function_exists('json_response')) {
    function json_response(array $content): string
    {
//        http_response_code();
        header('Content-Type: application/json');

        return json_encode($content);
    }
}

if (!function_exists('any_empty')) {
    function any_empty(...$items): bool
    {
        foreach ($items as $item) {
            if (empty($item)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('get_client')) {
    function get_client(): \GuzzleHttp\Client
    {
        return new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => 'Website/dunctebot.com',
            ],
        ]);
    }
}

if (!function_exists('verify_captcha')) {
    function verify_captcha(string $token): bool
    {
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $remoteIp = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $remoteIp = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remoteIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $remoteIp = $_SERVER['REMOTE_ADDR'];
        }

        try {
            $res = get_client()->post('https://hcaptcha.com/siteverify', [
                'form_params' => [
                    'secret' => env('HCAPTCHA_SECRET'),
                    'response' => $token,
                    'remoteip' => $remoteIp,
                ],
            ]);

            return json_decode($res->getBody())->success;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return false;
        }
    }
}

if (!function_exists('add_trello_card')) {
    function add_trello_card(string $name, string $desc): ?stdClass
    {
        try {
            $res = get_client()->post('https://api.trello.com/1/cards', [
                'query' => [
                    'name' => $name,
                    'desc' => $desc,
                    'pos' => 'bottom',
                    'idList' => '5ad2a228bef59be0aca289c9',
                    'keepFromSource' => 'all',
                    'key' => env('TRELLO_KEY'),
                    'token' => env('TRELLO_TOKEN'),
                ],
            ]);

            return json_decode($res->getBody());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return null;
        }
    }
}
