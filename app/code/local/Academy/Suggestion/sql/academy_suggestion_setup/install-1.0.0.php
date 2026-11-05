<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$connection = $installer->getConnection();

$categoryTable = $connection
    ->newTable($installer->getTable('academy_suggestion/category'))
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ], 'Category ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
        'nullable' => false,
    ], 'Name')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
        'unsigned' => true,
        'nullable' => false,
        'default'  => 1,
    ], 'Is Active')
    ->setComment('Academy Suggestion Category');

$connection->createTable($categoryTable);

$suggestionTable = $connection
    ->newTable($installer->getTable('academy_suggestion/suggestion'))
    ->addColumn('suggestion_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ], 'Suggestion ID')
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'unsigned' => true,
        'nullable' => false,
    ], 'Category ID')
    ->addColumn('author_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
        'nullable' => false,
    ], 'Author Name')
    ->addColumn('author_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, [
        'nullable' => false,
    ], 'Author Email')
    ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', [
        'nullable' => false,
    ], 'Message')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
        'unsigned' => true,
        'nullable' => false,
        'default'  => 1,
    ], 'Status')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, [
        'unsigned' => true,
        'nullable' => false,
        'default'  => 0,
    ], 'Store ID')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, [
        'nullable' => false,
        'default'  => Varien_Db_Ddl_Table::TIMESTAMP_INIT,
    ], 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, [
        'nullable' => false,
        'default'  => Varien_Db_Ddl_Table::TIMESTAMP_INIT_UPDATE,
    ], 'Updated At')
    ->addIndex(
        $installer->getIdxName('academy_suggestion/suggestion', ['status']),
        ['status']
    )
    ->addIndex(
        $installer->getIdxName('academy_suggestion/suggestion', ['category_id']),
        ['category_id']
    )
    ->addForeignKey(
        $installer->getFkName(
            'academy_suggestion/suggestion',
            'category_id',
            'academy_suggestion/category',
            'category_id'
        ),
        'category_id',
        $installer->getTable('academy_suggestion/category'),
        'category_id',
        Varien_Db_Ddl_Table::ACTION_RESTRICT,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Academy Suggestion');

$connection->createTable($suggestionTable);

$connection->insertMultiple($installer->getTable('academy_suggestion/category'), [
    ['name' => 'Produtos'],
    ['name' => 'Entrega'],
    ['name' => 'Atendimento'],
    ['name' => 'Site'],
]);

$installer->endSetup();