<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Spryker\Zed\Application\Communication\ZedBootstrap;
use Spryker\Shared\Config\Application\Environment;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Session;
use Silex\Application;
use Behat\Mink\Mink;
use Symfony\Component\HttpKernel\Client;

abstract class MinkTestCase extends TestCase
{
    const MINK_SESSION = 'spryker';

    /**
     * @var Session
     */
    private $mink;

    abstract protected function createApplication(): Application;

    protected function mink(): Mink
    {
        if (null === $this->mink) {
            $this->init();
        }

        return $this->mink;
    }

    protected function session(): Session
    {
        return $this->mink()->getSession(self::MINK_SESSION);
    }

    private function init()
    {
        Environment::initialize();
        $this->application = $this->createApplication();

        $this->mink = new Mink([
            self::MINK_SESSION => new Session(new BrowserKitDriver(new Client($this->application)))
        ]);

        $this->mink->setDefaultSessionName(self::MINK_SESSION);
    }

    protected function dumpPage()
    {
        echo $this->session()->getPage()->getContent().PHP_EOL;
    }

    public function assertStatusCode(int $expectedStatusCode)
    {
        $actualCode = $this->session()->getStatusCode();
        $this->assertEquals($expectedStatusCode, $actualCode);
    }
}
