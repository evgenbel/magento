<?php
/**
 * Created by PhpStorm.
 * User: Evgenii
 * Date: 19.02.2016
 * Time: 16:45
 */

class Veeble_Giftregistry_Test_Model_Registry extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Listing available registries
     *
     * @test
     * @loadFixture registryList.yaml
     * @doNotIndexAll
     */
    public function registryList()
    {
        $registryList = Mage::getModel('core/store')
            ->getCollection();
        foreach($registryList as $val){
            print_r($val->getId());
        }
        /*$registryList = Mage::getModel('veeble_giftregistry/entity')
            ->getCollection();
        print_r((string)$registryList->getSelect());*/
        $customerId = 1;
        $registryList = Mage::getModel('veeble_giftregistry/entity')
            ->getCollection()
            ->addFieldToFilter('customer_id', $customerId);
        $this->assertEquals(2, $registryList->count());
    }
}