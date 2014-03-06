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
        if ($this->settings->partialDir) {
            $partialDir = $this->settings->partialDir;
        } else {
            $partialDir = $this->settings->templateDir . 'partials/';
        }

        $options = array(
            'partials_loader' => new \Mustache_Loader_FilesystemLoader($partialDir),
        );
        $mustacheEngine = new \Mustache_Engine($options);

        return $mustacheEngine->render($string, $templateData);
    }

    public function render($file, $templateData)
    {
        return $this->renderString(file_get_contents($file), $templateData);
    }
}
