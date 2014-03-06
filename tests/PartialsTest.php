<?php

namespace Ornamental\Tests;

class PartialsTest extends OrnamentalTestSuite
{
    public function testDefaultPartialDir()
    {
        $message = new \Ornamental\Message('uses_partials');
        $message->user = array(
            'username' => 'Example User',
            'email' => 'test.user@example.com',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>


Start

Inner Partial

End

</html>

END;

        $this->assertEquals($expected, $html);

    }

    public function testCustomPartialDir()
    {
        $setup = \Ornamental\Settings::getInstance();
        $setup->partialDir = __DIR__ . '/separate_partial_dir/';

        $message = new \Ornamental\Message('uses_partials');
        $message->user = array(
            'username' => 'Example User',
            'email' => 'test.user@example.com',
        );

        $html = $message->renderHtml();
        $expected = <<<END
<html>


Start

Different Inner Partial

End

</html>

END;

        $this->assertEquals($expected, $html);

    }
}
