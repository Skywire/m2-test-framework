<?php
/**
 * Copyright © Skywire Ltd. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Skywire\TestFramework\Integration;

/**
 * @package     Skywire\TestFramework\Integration
 * @author      Skywire Tech Team <tech@skywire.co.uk>
 */
class TestCase
    extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $objectManager;

    /**
     * @var FixtureLoader
     */
    protected static $fixtureLoader;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        self::$fixtureLoader = $this->objectManager->create(FixtureLoader::class);

        parent::__construct($name, $data, $dataName);
    }

    protected static function loadFixtureFile($filename)
    {
        self::$fixtureLoader->load($filename);
    }
}
