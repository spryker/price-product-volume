<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\PriceProductVolume\Plugin\PriceProductStorageExtension;

use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\StorePriceProductStoragePricesExtractorPluginInterface;

/**
 * @method \Spryker\Client\PriceProductVolume\PriceProductVolumeClientInterface getClient()
 */
class PriceProductVolumeExtractorPlugin extends AbstractPlugin implements PriceProductStoragePricesExtractorPluginInterface, StorePriceProductStoragePricesExtractorPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\PriceProductTransfer> $priceProductTransfers
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function extractProductPricesForProductAbstract(array $priceProductTransfers): array
    {
        return $this->getClient()
            ->extractProductPricesForProductAbstract($priceProductTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductConcrete
     * @param array<\Generated\Shared\Transfer\PriceProductTransfer> $priceProductTransfers
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function extractProductPricesForProductConcrete(int $idProductConcrete, array $priceProductTransfers): array
    {
        return $this->getClient()
            ->extractProductPricesForProductConcrete($idProductConcrete, $priceProductTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idProductConcrete
     * @param array<\Generated\Shared\Transfer\PriceProductTransfer> $priceProductTransfers
     * @param string $storeName
     *
     * @return array<\Generated\Shared\Transfer\PriceProductTransfer>
     */
    public function extractProductPricesForProductConcreteForStore(int $idProductConcrete, array $priceProductTransfers, string $storeName): array
    {
        return $this->getClient()
            ->extractProductPricesForProductConcrete($idProductConcrete, $priceProductTransfers, $storeName);
    }
}
