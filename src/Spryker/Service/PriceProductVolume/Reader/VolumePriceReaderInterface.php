<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\PriceProductVolume\Reader;

use Generated\Shared\Transfer\PriceProductTransfer;

interface VolumePriceReaderInterface
{
    public function hasVolumePrices(PriceProductTransfer $priceProductTransfer): bool;

    public function extractVolumePrice(
        PriceProductTransfer $priceProductTransfer,
        PriceProductTransfer $volumePriceProductTransfer
    ): ?PriceProductTransfer;
}
