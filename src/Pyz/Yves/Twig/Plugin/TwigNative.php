<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Twig\Plugin;

use Pyz\Yves\Twig\Dependency\Plugin\TwigFilterPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig_SimpleFilter;

class TwigNative extends AbstractPlugin implements TwigFilterPluginInterface
{
    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        $appPath = 'src/app';
        $componentsPath = $appPath . '/components';

        return [
            new Twig_SimpleFilter('floor', function ($value) {
                return floor($value);
            }),
            new Twig_SimpleFilter('ceil', function ($value) {
                return ceil($value);
            }),
            new Twig_SimpleFilter('int', function ($value) {
                return (int)$value;
            }),

            // components (atomic design) filters
            new Twig_SimpleFilter('C', function ($value) use ($componentsPath) {
                return $componentsPath . '/base/' . $value . '.twig';
            }),
            new Twig_SimpleFilter('A', function ($value) use ($componentsPath) {
                return $componentsPath . '/atoms/' . $this->getTemplateFilename($value);
            }),
            new Twig_SimpleFilter('M', function ($value) use ($componentsPath) {
                return $componentsPath . '/molecules/' . $this->getTemplateFilename($value);
            }),
            new Twig_SimpleFilter('O', function ($value) use ($componentsPath) {
                return $componentsPath . '/organisms/' . $this->getTemplateFilename($value);
            }),
            new Twig_SimpleFilter('T', function ($value) use ($appPath) {
                return $appPath .'/templates/' . $this->getTemplateFilename($value);
            }),
        ];
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getTemplateFilename($name)
    {
        return $name . '/' . $name . '.twig';
    }

}
