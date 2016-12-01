<?php

namespace Pyz\Zed\Api\Business;

use Pyz\Zed\Api\Business\Model\ApiEntry;
use Pyz\Zed\Api\Business\Model\TransferAnnotator;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ApiBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @param string $bundle
     *
     * @return \Spryker\Zed\Kernel\Business\AbstractFacade
     */
    protected function getBundleFacade($bundle)
    {
        $locator = $this->createContainer()->getLocator();
        return $locator->$bundle()->facade();
    }

    /**
     * @param string $bundle
     *
     * @return \Pyz\Zed\Api\Business\Model\ApiEntryInterface
     */
    public function createFacadeProxy($bundle)
    {
        return new ApiEntry(
            $this->getBundleFacade($bundle)
        );
    }

    /**
     * @return \Pyz\Zed\Api\Business\Model\TransferAnnotatorInterface
     */
    public function createTransferAnnotator()
    {
        return new TransferAnnotator();
    }

}