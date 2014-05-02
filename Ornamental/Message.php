<?php

namespace Ornamental;

use Symfony\Component\Yaml\Yaml;

class Message
{
    public $name;
    public $to;
    public $from;
    public $fromName;
    public $subject;
    public $layout;
    public $template;
    public $required = array();

    protected $originalSubject;
    protected $settings;
    protected $templateData = array();

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

        $this->prepareMeta();

        foreach ($this->settings->senders as $sender) {
            $sender->send($this);
        }
    }

    public function getTemplateData()
    {
        return array_merge($this->settings->defaults, $this->templateData);
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

    protected function prepareMeta()
    {
        $templateData = $this->getTemplateData();
        $this->to = $this->replaceVar($this->to, $templateData);
        $this->from = $this->replaceVar($this->from, $templateData);
        $this->fromName = $this->replaceVar($this->fromName, $templateData);

        if (!$this->originalSubject) {
            $this->originalSubject = $this->subject;
        }

        $this->subject = $this->settings->subjectPrefix . $this->replaceVar($this->originalSubject, $templateData);
    }

    private function replaceVar($str, $data)
    {
        return $this->settings->metaRenderer->renderString($str, $data);
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
