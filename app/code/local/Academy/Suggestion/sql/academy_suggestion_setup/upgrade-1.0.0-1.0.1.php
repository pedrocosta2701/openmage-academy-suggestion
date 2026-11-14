<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$connection = $installer->getConnection();
$tableName = $installer->getTable('academy_suggestion/suggestion');

$connection->addColumn($tableName, 'reminded_at', [
    'type'     => Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
    'nullable' => true,
    'default'  => null,
    'comment'  => 'Reminded At',
]);

$connection->addIndex(
    $tableName,
    $installer->getIdxName('academy_suggestion/suggestion', ['reminded_at']),
    ['reminded_at']
);

$installer->endSetup();