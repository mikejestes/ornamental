<?php

namespace Ornamental\Renderer;

class Php
{
    public $extension = '.php';

    private $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function renderString($string, $templateData)
    {
        throw Exception("Php renderer is not support for metaRendering.");
    }

    public function render($file, $templateData)
    {
        extract($templateData);
        ob_start();
        require($file);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
