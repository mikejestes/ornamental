<?php

namespace Ornamental\Tests;

class RenderMustacheTest extends OrnamentalTestSuite
{
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

END;

        $this->assertEquals($expected, $text);
    }
}
