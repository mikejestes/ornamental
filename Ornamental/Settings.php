<?php

namespace Ornamental;

class Settings
{
    public $templateDir;
    public $messageDir;
    public $layoutDir;
    public $sender;
    public $metaRenderer;

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Settings();
            self::$instance->sender = new Sender\Null(self::$instance);
            self::$instance->metaRenderer = new Renderer\Mustache(self::$instance);
        }

        return self::$instance;
    }
}
