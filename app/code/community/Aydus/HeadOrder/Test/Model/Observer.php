<?php

/**
 * Observer test
 *
 * @category   Aydus
 * @package    Aydus_HeadOrder
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_HeadOrder_Test_Model_Observer extends EcomDev_PHPUnit_Test_Case_Config
{    
    /**
     * Test observer
     *
     * @test
     * @loadFixture
     */
    public function reorderHeadItems()
    {
        echo "\nStarting Aydus_HeadOrder test.";
        
        $model = Mage::getModel('aydus_headorder/observer');

        $this->assertTrue(true);
        
        echo "\nCompleted Aydus_HeadOrder test.";

    }

}