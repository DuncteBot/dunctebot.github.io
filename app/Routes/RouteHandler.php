<?php
/**
 * This is free and unencumbered software released into the public domain.
 *
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 *
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * For more information, please refer to <http://unlicense.org>
 */

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
