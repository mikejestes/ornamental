<?php

namespace Ornamental;

use Symfony\Component\Yaml\Yaml;

class Message
{
    public $name;
    public $to;
    public $from;
    public $subject;
    public $layout;
    public $template;
    public $required = array();

    private $settings;
    private $templateData = array();

    public function __construct($name, $settings = null)
    {
        if ($settings === null) {
            $settings = Settings::getInstance();
        }

        $this->name = $name;
        $this->settings = $settings;
        $this->loadMessageDefinition($name);
    }

    public function __set($key, $value)
    {
        $this->templateData[$key] = $value;
    }

    public function send()
    {
        foreach ($this->required as $requiredKey) {
            if (!isset($this->templateData[$requiredKey])) {
                throw new \Exception("$requiredKey is required to be set on message $this->name");
            }
        }

        $deliveries = Deliveries::getInstance();
        $deliveries->add($this);

        $sender = $this->settings->sender;
        $sender->send($this);
    }

    public function getTemplateData()
    {
        return $this->templateData;
    }

    public function renderHtml()
    {
        $renderer = new Renderer($this->settings);
        return $renderer->render($this);
    }

    public function renderText()
    {
        $renderer = new Renderer($this->settings);
        return $renderer->renderText($this);
    }

    private function loadMessageDefinition($name)
    {
        $file = $this->settings->messageDir . '/' . $name . '.yaml';
        if (!is_file($file)) {
            throw new \Exception("$name message not found in {$this->settings->messageDir}");
        }

        $yaml = Yaml::parse($file);

        foreach ($yaml as $key => $value) {
            $this->$key = $value;
        }

        if (!$this->layout) {
            $this->layout = $this->name;
        }
    }
}
