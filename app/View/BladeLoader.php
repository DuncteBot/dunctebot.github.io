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

use Windwalker\Renderer\BladeRenderer;

class BladeLoader
{
    /**
     * @var BladeRenderer
     */
    private $renderer;
    private $shares;

    /**
     * BladeLoader constructor.
     *
     * @param $viewPath
     */
    public function __construct($viewPath)
    {
        $paths = [$viewPath];
        $this->renderer = new BladeRenderer($paths, [
            'cache_path' => __DIR__ . '/../../storage/app/views',
        ]);

        $this->loadShares();
    }

    public function loadShares()
    {
        $this->shares = require __DIR__ . '/../../resources/viewShares.php';

        // Custom compilers before loading the engine
        $this->renderer->addCustomCompiler('checkActiveClass', function ($expression) {
            return '<?php if($__env->yieldContent(\'title\') === ('.$expression.')) { echo \'class="active"\'; } ?>';
        });

        $prefix = $this->shares['prefix'];
        $this->renderer->addCustomCompiler('generateCommands', function () use ($prefix) {
            $commands = \json_decode(\file_get_contents(__DIR__ . '/../../resources/commands.json'));
            $output = '';

            foreach ($commands as $command) {
                $output .= '<tr id="'.$command->name.'"><td>'.$prefix.$command->name.'</td><td>'.$command->help.'</td></tr>';
            }

            return $output;
        });

        $this->renderer->addCustomCompiler('insertCommandsJson', function () {
            return \file_get_contents(__DIR__ . '/../../resources/commands.json');
        });
        $engine = $this->renderer->getEngine();

        foreach ($this->shares as $key => $value) {
            $engine->share($key, $value);
        }
    }

    public function view(string $filename, array $data = []): string
    {
        return $this->renderer->render($filename, $data);
    }


}
