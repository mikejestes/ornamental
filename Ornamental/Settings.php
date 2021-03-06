<?php

namespace Ornamental;

class Settings
{
    public $templateDir;
    public $messageDir;
    public $layoutDir;
    public $partialDir;

    public $senders = array();
    public $defaults = array();
    public $metaRenderer;
    public $subjectPrefix = '';

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Settings();
            self::$instance->addSender(new Sender\Null(self::$instance));
            self::$instance->metaRenderer = new Renderer\Mustache(self::$instance);
        }

        return self::$instance;
    }

    public function addSender(\Ornamental\Sender $sender)
    {
        $this->senders[] = $sender;
    }
}
