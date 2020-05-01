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

namespace App\View;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory as BladeEnvironment;
use Illuminate\View\FileViewFinder;

class BladeLoader
{
    /**
     * @var \Illuminate\View\Factory
     */
    private $bladeEnv;

    /**
     * @var \Illuminate\View\Compilers\BladeCompiler
     */
    private $bladeCompiler;

    /**
     * BladeLoader constructor.
     *
     * @param $viewPath
     */
    public function __construct($viewPath)
    {
        // Rip windwalker/renderer, we'll just use blade from now on
        $paths = [$viewPath];
        $cachePath = __DIR__ . '/../../storage/app/views';
        $resolver = new EngineResolver();
        $filesystem = new Filesystem();
        $compiler = new CompilerEngine(new BladeCompiler($filesystem, $cachePath));
        $finder = new FileViewFinder($filesystem, $paths);
        $dispatcher = new Dispatcher();

        $resolver->register(
            'blade',
            function () use ($compiler) {
                return $compiler;
            }
        );

        $this->bladeEnv = new BladeEnvironment($resolver, $finder, $dispatcher);
        $this->bladeCompiler = $compiler->getCompiler();

        $this->loadShares();
    }

    public function loadShares()
    {
        $shares = require __DIR__ . '/../../resources/viewShares.php';

        // Custom compilers before loading the engine
        $this->addDirective('checkActiveClass', static function ($expression) {
            return '<?php if($__env->yieldContent(\'title\') === (' . $expression . ')) { echo \'class="active"\'; } ?>';
        });

        $prefix = $shares['prefix'];
        $this->addDirective('generateCommands', static function () use ($prefix) {
            $commands = \json_decode(\file_get_contents(__DIR__ . '/../../resources/commands.json'));
            $output = '';

            foreach ($commands as $command) {
                $output .= '<tr id="' . $command->name . '"><td>' . $prefix . $command->name . '</td><td>' . $command->help . '</td></tr>';
            }

            return $output;
        });

        $this->addDirective('insertCommandsJson', static function () {
            return \file_get_contents(__DIR__ . '/../../resources/commands.json');
        });


        $this->addDirective('generateRadioList', static function () {
            $compressedPath = __DIR__ . '/../../resources/radio_streams_flat.json';

            // Sort and compress the file once for faster loads next time
            if (!\file_exists($compressedPath)) {
                $s = \json_decode(\file_get_contents(__DIR__ . '/../../resources/radio_streams.json'));

                $mapped = array_map(static function ($element) {
                    return $element->name;
                }, $s);

                // fix all the quotes
                $s = array_map(static function ($element) {
                    unset($element->audio);

                    return $element;
                }, $s);

                \array_multisort($mapped, SORT_ASC, $s);

                \file_put_contents($compressedPath, \json_encode($s));
//                \file_put_contents($compressedPath . '_test.json', \json_encode(\array_values(\array_unique($s, SORT_REGULAR))));
            }

            $streams = \json_decode(\file_get_contents($compressedPath));
            $output = '';

            foreach ($streams as $stream) {
                $output .= "<tr><td>$stream->name</td><td><a href=\"$stream->website\" target=\"_blank\">$stream->website</a></td></tr>";
            }

            return $output;
        });

        $this->addDirective('insertRadioJson', static function () {
            return \file_get_contents(__DIR__ . '/../../resources/radio_streams_flat.json');
        });

        /*$this->addDirective('timestamp', static function () {
            return time();
        });*/

        foreach ($shares as $key => $value) {
            $this->bladeEnv->share($key, $value);
        }
    }

    private function addDirective(string $name, \Closure $callback)
    {
        $this->bladeCompiler->directive($name, $callback);
    }

    public function view(string $filename, array $data = []): string
    {
        return $this->bladeEnv->make($filename, $data)->render();
    }
}
