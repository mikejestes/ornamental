<?php

namespace Ornamental\Tests;

class RenderMustacheTest extends OrnamentalTestSuite
{
    public function setUp()
    {
        parent::setUp();
        $setup = \Ornamental\Settings::getInstance();

        $setup->defaults = array(
            'website' => 'http://example.com',
        );
    }

    public function testRenderHtml()
    {
        $message = new \Ornamental\Message('user_hello');
        $message->user = array(
            'name' => 'Example User',
            'email' => 'test.user@example.com',
            'link' => 'http://cnn.com/',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>
<body>

<table>
<tr>
<td>

Dear Example User,<br><br>

Welcome to our service. We really thank you for signing up.<br><br>

<a href="http://cnn.com/">Come check us out</a>.<br><br>

--<br>
The Team
<a href="http://example.com">Website</a>.

</td>
</tr>
</table>

</body>
</html>

END;

        $this->assertEquals($expected, $html);

    }

    /**
     * Test text render functionality, utilizing optional layout
     */
    public function testRenderText()
    {
        $message = new \Ornamental\Message('user_hello');
        $message->user = array(
            'name' => 'Example User',
            'email' => 'test.user@example.com',
            'link' => 'http://cnn.com/',
        );

        $text = $message->renderText();
        $expected = <<<END

Dear Example User,

Welcome to our service. We really thank you for signing up.

Come check us out: http://cnn.com/

--
The Team
http://example.com

END;

        $this->assertEquals($expected, $text);
    }
}
