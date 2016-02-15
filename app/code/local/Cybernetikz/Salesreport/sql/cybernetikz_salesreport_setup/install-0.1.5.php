<?php
/**
 * Created by PhpStorm.
 * User: Евгений
 * Date: 27.01.2016
 * Time: 21:18
 */

$installer = $this;
$installer->startSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$setup->addAttribute('order', 'ref', array(
    'position'      => 1,
    'input'         => 'text',
    'type'          => 'varchar',
    'label'         => 'ref number',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'global'        => 1,
    'visible_on_front'  => 0,
));

$installer->endSetup();