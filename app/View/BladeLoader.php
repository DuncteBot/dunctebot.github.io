<?php

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
