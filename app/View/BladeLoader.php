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
        // Custom compilers before loading the engine
        $this->renderer->addCustomCompiler('checkActiveClass', function ($expression) {
            return '<?php if($__env->yieldContent(\'title\') === ('.$expression.')) { echo \'class="active"\'; } ?>';
        });

        $this->renderer->addCustomCompiler('generateCommands', function () {
            $commands = json_decode(file_get_contents(__DIR__ . '/../../resources/commands.json'));
            $output = '';

            foreach ($commands as $command) {
                $output .= '<tr id="'.$command->name.'"><td><?php echo $prefix; ?>'.$command->name.'</td><td>'.$command->help.'</td></tr>';
            }

            return $output;
        });

        $this->renderer->addCustomCompiler('insertCommandsJson', function () {
            return file_get_contents(__DIR__ . '/../../resources/commands.json');
        });

        $this->shares = require __DIR__ . '/../../resources/viewShares.php';
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
