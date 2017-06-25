<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\Twig;

use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Kernel\Store;
use Spryker\Shared\Twig\TwigConstants;
use Spryker\Yves\Kernel\AbstractBundleConfig;
use Spryker\Yves\Twig\TwigConfig as SprykerTwigConfig;

class TwigConfig extends SprykerTwigConfig
{

    /**
     * @param array $paths
     *
     * @return array
     */
    protected function addProjectTemplatePaths(array $paths)
    {
        $themeName = $this->getThemeName();
        $defaultPaths = parent::addProjectTemplatePaths($paths);

        $defaultPaths[] = APPLICATION_ROOT_DIR . '/frontend/Yves/' . $themeName . '/src';
        $defaultPaths[] = APPLICATION_ROOT_DIR . '/frontend/Yves/' . $themeName;

        return $defaultPaths;
    }

}
