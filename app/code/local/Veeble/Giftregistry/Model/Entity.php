<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 21:02
 */

class Veeble_Giftregistry_Model_Entity extends Mage_Core_Model_Abstract
{
    CONST DISABLE = 0;
    CONST ENABLE = 1;

    public function __construct()
    {
        $this->_init('veeble_giftregistry/entity');
        parent::_construct();
    }

    public function updateRegistryData(Mage_Customer_Model_Customer $customer, $data)
    {
        try {
            if (!empty($data)) {
                $this->setCustomerId($customer->getId());
                $this->setWebsiteId($customer->getWebsiteId());
                $this->setTypeId($data['type_id']);
                $this->setEventName($data['event_name']);
                $this->setEventDate($data['event_date']);
                $this->setEventCountry($data['event_country']);
                $this->setEventLocation($data['event_location']);
            } else {
                throw new Exception("Error Processing Request:Insufficient Data Provided");
            }
        } catch (Exception $e) {
            Mage::logException($e);
        }
        return $this;
    }

    public function getStatuses(){
        return array(
            self::DISABLE   =>  Mage::helper('veeble_giftregistry')->__('Disable'),
            self::ENABLE   =>  Mage::helper('veeble_giftregistry')->__('Enable'),
        );
    }

    public function enable(){
        $this->setStatus(self::ENABLE);
    }

    public function disable(){
        $this->setStatus(self::DISABLE);
    }

    public function getId()
    {
        return $this->getEntityId();
    }
}