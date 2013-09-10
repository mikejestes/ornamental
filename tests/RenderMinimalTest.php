<?php

namespace Ornamental\Tests;

class RenderMinimalTest extends OrnamentalTestSuite
{
    public function testRenderHtml()
    {
        $message = new \Ornamental\Message('minimal');
        $message->user = array(
            'name' => 'Example User',
            'email' => 'test.user@example.com',
            'link' => 'http://cnn.com/',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>


Dear Example User,<br><br>

Welcome to our service. We really thank you for signing up.<br><br>

<a href="http://cnn.com/">Come check us out</a>.<br><br>

--<br>
The Team

</html>

END;

        $this->assertEquals($expected, $html);

    }

    public function testRenderDotsInPath()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->templateDir = __DIR__ . '/../tests/templates/';
        $setup->layoutDir = __DIR__ . '/../tests/layouts/';
        $setup->messageDir = __DIR__ . '/../tests/messages/';

        $message = new \Ornamental\Message('minimal');
        $message->user = array(
            'name' => 'Example User',
            'email' => 'test.user@example.com',
            'link' => 'http://cnn.com/',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>


Dear Example User,<br><br>

Welcome to our service. We really thank you for signing up.<br><br>

<a href="http://cnn.com/">Come check us out</a>.<br><br>

--<br>
The Team

</html>

END;

        $this->assertEquals($expected, $html);

    }
}
