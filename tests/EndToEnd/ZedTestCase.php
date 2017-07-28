<?php

namespace Tests\EndToEnd;

define('APPLICATION_ROOT_DIR', __DIR__ . '/../..');
define('APPLICATION', 'ZED');
define('APPLICATION_ENV', 'devtest');

use Tests\MinkTestCase;
use Silex\Application;
use Spryker\Shared\Config\Application\Environment;
use Spryker\Zed\Testify\Bootstrap\ZedBootstrap;

class ZedTestCase extends MinkTestCase
{
    public function createApplication(): Application
    {
        Environment::initialize();
        $bootstrap = new ZedBootstrap([
        ]);

        return $bootstrap->boot();
    }
}

