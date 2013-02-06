<?php

namespace Ornamental;

class Renderer
{
    private $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    public function render($message, $prefix = '', $suffix = '')
    {
        $templateGlob = $this->settings->templateDir . '/' . $prefix . $message->name . $suffix;
        $layoutGlob = $this->settings->layoutDir . '/' . $prefix . $message->layout . $suffix;

        $templateData = $message->getTemplateData();

        $body = $this->renderGlob($templateGlob, $templateData);

        $layoutData = array_merge(
            $templateData,
            array(
                'body' => $body,
            )
        );

        $layout = $this->renderGlob($layoutGlob, $layoutData);

        if (strlen($layout)) {
            return $layout;
        } else {
            return $body;
        }
    }

    public function renderText($message)
    {
        return $this->render($message, 'text_');
    }

    private function renderGlob($glob, $templateData)
    {
        $globResults = glob($glob . '*');

        if (count($globResults)) {
            $file = array_shift($globResults);
            return $this->renderFile($file, $templateData);
        }
    }

    private function renderFile($file, $templateData)
    {
        $dot = strpos($file, '.');
        $extension = ucfirst(substr($file, $dot + 1));

        $class = "\Ornamental\Renderer\\$extension";
        $renderer = new $class($this->settings);
        return $renderer->render($file, $templateData);
    }
}
