<?php

namespace Skywire\TestFramework\Integration;

class TestCase
    extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    protected $objectManager;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        $this->objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

        parent::__construct($name, $data, $dataName);
    }

}
