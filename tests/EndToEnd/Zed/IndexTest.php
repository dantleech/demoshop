<?php

namespace Tests\EndToEnd\Zed;

use Tests\EndToEnd\ZedTestCase;

class IndexTest extends ZedTestCase
{
    /**
     * @testdox It should render the index page.
     */
    public function testIndex()
    {
        $this->session()->visit('/');
        $this->assertStatusCode(200);
        $this->mink()->assertSession('spryker')->pageTextContains('Welcome');
    }
}
