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

    public function renderString($string, $templateData)
    {
        $mustacheEngine = new \Mustache_Engine();
        return $mustacheEngine->render($string, $templateData);
    }

    public function render($file, $templateData)
    {
        return $this->renderString(file_get_contents($file), $templateData);
    }
}
