<?php

/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 28.01.2016
 * Time: 22:05
 */
class Veeble_Giftregistry_SearchController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function resultsAction()
    {
        $this->loadLayout();
        if ($searchParams = $this->getRequest()->getParam('search_params')) {
            $results = Mage::getModel('veeble_giftregistry/entity')->getCollection();
            if ($searchParams['type']) {
                $results->addFieldToFilter('type_id',
                    $searchParams['type']);
            }
            if ($searchParams['date']) {
                $results->addFieldToFilter('event_date',
                    $searchParams['date']);
            }
            if ($searchParams['location']) {
                $results->addFieldToFilter('event_location',
                    $searchParams['location']);
            }
            $this->getLayout()->getBlock('veeble_giftregistry.search.results')
                ->setCustomerRegistries($results);
        }
        $this->renderLayout();
        return $this;
    }
}