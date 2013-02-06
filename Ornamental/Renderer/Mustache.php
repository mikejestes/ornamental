<?php

namespace Ornamental\Renderer;

class Mustache
{
    public $extension = '.mustache';

    private $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function render($file, $templateData)
    {
        $mustacheEngine = new \Mustache_Engine();
        return $mustacheEngine->render(file_get_contents($file), $templateData);
    }
}
