<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\PriceProductVolume\Reader;

use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Spryker\Service\PriceProductVolume\Dependency\Service\PriceProductVolumeToUtilEncodingServiceInterface;
use Spryker\Shared\PriceProductVolume\PriceProductVolumeConfig;

class VolumePriceReader implements VolumePriceReaderInterface
{
    /**
     * @var \Spryker\Service\PriceProductVolume\Dependency\Service\PriceProductVolumeToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    public function __construct(PriceProductVolumeToUtilEncodingServiceInterface $utilEncodingService)
    {
        $this->utilEncodingService = $utilEncodingService;
    }

    public function hasVolumePrices(PriceProductTransfer $priceProductTransfer): bool
    {
        $volumePriceData = $this->getVolumePriceData($priceProductTransfer);

        return (bool)$volumePriceData;
    }

    public function extractVolumePrice(
        PriceProductTransfer $priceProductTransfer,
        PriceProductTransfer $volumePriceProductTransfer
    ): ?PriceProductTransfer {
        $volumePriceData = $this->getVolumePriceData($priceProductTransfer);
        $moneyValueTransfer = $priceProductTransfer->getMoneyValueOrFail();

        foreach ($volumePriceData as $volumePriceDataElement) {
            if ($this->isSameQuantity($volumePriceDataElement, $volumePriceProductTransfer)) {
                $volumeMoneyValueTransfer = $this->getVolumeMoneyValueTransfer(
                    $volumePriceDataElement,
                    $moneyValueTransfer,
                );

                $volumePriceProductTransfer->setMoneyValue($volumeMoneyValueTransfer);

                return $volumePriceProductTransfer;
            }
        }

        return null;
    }

    protected function getVolumePriceData(PriceProductTransfer $priceProductTransfer): array
    {
        $priceData = $this->utilEncodingService->decodeJson(
            $priceProductTransfer->getMoneyValueOrFail()->getPriceData(),
            true,
        );

        if (!is_array($priceData)) {
            $priceData = [];
        }

        return $priceData[PriceProductVolumeConfig::VOLUME_PRICE_TYPE] ?? [];
    }

    protected function isSameQuantity(array $volumePriceDataElement, PriceProductTransfer $priceProductTransfer): bool
    {
        return (int)$volumePriceDataElement[PriceProductVolumeConfig::VOLUME_PRICE_QUANTITY] === (int)$priceProductTransfer->getVolumeQuantityOrFail();
    }

    /**
     * @param array<mixed> $volumePriceDataItem
     * @param \Generated\Shared\Transfer\MoneyValueTransfer $moneyValueTransfer
     *
     * @return \Generated\Shared\Transfer\MoneyValueTransfer
     */
    protected function getVolumeMoneyValueTransfer(
        array $volumePriceDataItem,
        MoneyValueTransfer $moneyValueTransfer
    ): MoneyValueTransfer {
        return (new MoneyValueTransfer())
            ->setGrossAmount($volumePriceDataItem[PriceProductVolumeConfig::VOLUME_PRICE_GROSS_PRICE])
            ->setNetAmount($volumePriceDataItem[PriceProductVolumeConfig::VOLUME_PRICE_NET_PRICE])
            ->setCurrency($moneyValueTransfer->getCurrency())
            ->setFkStore($moneyValueTransfer->getFkStore())
            ->setStore($moneyValueTransfer->getStore())
            ->setFkCurrency($moneyValueTransfer->getFkCurrency());
    }
}
