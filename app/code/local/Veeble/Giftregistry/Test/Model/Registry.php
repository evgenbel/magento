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
        $customerId = 1;
        $registryList = Mage::getModel('veeble_giftregistry/entity')
            ->getCollection()
            ->addFieldToFilter('customer_id', $customerId);
        $this->assertEquals(2, $registryList->count());
    }

    /**
     * Listing available items for a specific registry
     *
     * @test1
     * @loadFixture registryItemsList.yaml
     * @doNotIndexAll
     */
    public function registryItemsList()
    {
        $customerId = 1;
        $giftTable =  Mage::getSingleton('core/resource')->getTableName('veeble_giftregistry/entity');
        $registryItems = Mage::getModel('veeble_giftregistry/item')
            ->getCollection();
        $registryItems->getSelect()->join(array("g"=>$giftTable), "`main_table`.registry_id=g.entity_id", array())
        ->where("g.customer_id=?", $customerId);

        $this->assertEquals(
            3,
            $registryItems->count()
        );
    }
}