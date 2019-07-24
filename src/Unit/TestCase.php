<?php
/**
 * Copyright © Skywire Ltd. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Skywire\TestFramework\Unit;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 * @package     Skywire\TestFramework\Unit
 * @author      Skywire Tech Team <tech@skywire.co.uk>
 */
class TestCase
    extends \PHPUnit\Framework\TestCase
{
    /** @var ObjectManager */
    protected $objectManager;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->objectManager = new ObjectManager($this);
    }

}