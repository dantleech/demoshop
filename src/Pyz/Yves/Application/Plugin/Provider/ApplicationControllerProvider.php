<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Application\Plugin\Provider;

use Silex\Application;

class ApplicationControllerProvider extends AbstractYvesControllerProvider
{

    const ROUTE_HOME = 'home';
    const ROUTE_ERROR_404 = 'error/404';
    const ROUTE_ERROR_404_PATH = '/error/404';
    const ROUTE_ERROR_OFFLINE = 'offline';
    const ROUTE_ERROR_OFFLINE_PATH = 'offline';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $allowedLocalesPattern = $this->getAllowedLocalesPattern();

        $this->createController('/{root}', self::ROUTE_HOME, 'Application', 'home')
            ->assert('root', $allowedLocalesPattern)
            ->value('root', '');

        $this->createController(self::ROUTE_ERROR_404_PATH, self::ROUTE_ERROR_404, 'Application', 'e404');
        $this->createController(self::ROUTE_ERROR_OFFLINE_PATH, self::ROUTE_ERROR_OFFLINE, 'Application', 'offline');
    }

}
