<?php
/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 19.02.2016
 * Time: 16:45
 */

class Mdg_Giftregistry_Test_Model_Registry extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Listing available registries
     *
     * @test
     * @loadFixture
     * @doNotIndexAll
     * @dataProvider dataProvider
     */
    public function registryList()
    {
        $customerId = 1;
        $registryList = Mage::getModel('mdg_giftregistry/entity')
            ->getCollection()
            ->addFieldToFilter('customer_id', $customerId);
        $this->assertEquals(2, $registryList->count());
    }
}