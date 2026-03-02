<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\PriceProductVolume\Business\Validator\Constraint;

use Symfony\Component\Validator\Constraint as SymfonyConstraint;

class VolumeQuantityConstraint extends SymfonyConstraint
{
    /**
     * @var string
     */
    protected const MESSAGE = 'Invalid volume quantity.';

    public function getMessage(): string
    {
        return static::MESSAGE;
    }

    public function getTargets(): string
    {
        return static::CLASS_CONSTRAINT;
    }
}
