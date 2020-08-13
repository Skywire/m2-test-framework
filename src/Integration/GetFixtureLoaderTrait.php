<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace Skywire\TestFramework\Integration;

trait GetFixtureLoaderTrait
{
    public static function getFixtureLoader()
    {
         $om = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
         return $om->create(FixtureLoader::class);
    }
}
