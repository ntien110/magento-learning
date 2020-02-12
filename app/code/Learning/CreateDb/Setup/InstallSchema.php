<?php
/**
* Copyright © 2016 Magento. All rights reserved.
* See COPYING.txt for license details.
*/

namespace Learning\GreetingMessage\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table as MagType;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $table = $setup->getConnection()
            ->newTable($setup->getTable('actor'))
            ->addColumn(
                'actor_id',
                MagType::TYPE_INTEGER,
                10,
                ['identity'=>true, 'unsigned'=>true, 'nullable'=>false, 'primary'=> true])
            ->addColumn(
                'first_name',
                MagType::TYPE_TEXT,
                255,
                ['default'=>'']
            )
            ->addColumn(
                'last_name',
                MagType::TYPE_TEXT,
                255,
                ['default'=>'']
            )
            ->addColumn(
                'created_at',
                MagType::TYPE_TIMESTAMP
            )
            ->addColumn(
                'updated_at',
                MagType::TYPE_TIMESTAMP
            );
        $setup->getConnection()->createTable($table);


        $table = $setup->getConnection()
            ->newTable($setup->getTable('film'))
            ->addColumn(
                'film_id',
                MagType::TYPE_INTEGER,
                10,
                ['identity'=>true, 'unsigned'=>true, 'nullable'=>false, 'primary'=> true])
            ->addColumn(
                'title',
                MagType::TYPE_TEXT,
                255,
                ['default'=>'']
            )
            ->addColumn(
                'description',
                MagType::TYPE_TEXT,
                null,
                ['default'=>'']
            )
            ->addColumn(
                'language_id',
                MagType::TYPE_SMALLINT,
                5
            )
            ->addColumn(
                'original_language_id',
                MagType::TYPE_SMALLINT,
                5
            )->addColumn(
                'rental_duration',
                MagType::TYPE_SMALLINT,
                5
            )
            ->addColumn(
                'rental_rate',
                MagType::TYPE_DECIMAL,
                [4,2]
            )->addColumn(
                'length',
                MagType::TYPE_SMALLINT,
                5
            )->addColumn(
                'replacement_cost',
                MagType::TYPE_DECIMAL,
                [5,2]
            )->addColumn(
                'created_at',
                MagType::TYPE_TIMESTAMP
            )->addColumn(
                'updated_at',
                MagType::TYPE_TIMESTAMP
            );


        $table = $setup->getConnection()
            -> newTable($setup->getTable('film_actor'))
            -> addForeignKey(
                $setup->getFkName(
                    'film_actor',
                    'actor_id',
                    'actor',
                    'actor_id'
                    ),
                'actor_id',
                $setup->getTable('actor'),
                'actor_id'
            )
            -> addForeignKey(
                $setup->getFkName(
                    'film_actor',
                    'film_id',
                    'film',
                    'film_id'
                ),
                'film_id',
                $setup->getTable('film'),
                'film_id'
            );
        $setup->getConnection()->createTable($table);


        $table = $setup->getConnection()
            ->newTable($setup->getTable('category'))
            ->addColumn(
                'category_id',
                MagType::TYPE_INTEGER,
                10,
                ['identity'=>true, 'unsigned'=>true, 'nullable'=>false, 'primary'=> true]
            )
            -> addColumn(
                'name',
                MagType::TYPE_TEXT,
                255
            )
            -> addColumn(
                'created_at',
                MagType::TYPE_TIMESTAMP
            )
            -> addColumn(
                'updated_at',
                MagType::TYPE_TIMESTAMP
            );
        $setup->getConnection()->createTable($table);


        $table = $setup->getConnection()
            -> newTable($setup->getTable('film_category'))
            -> addForeignKey(
                $setup->getFkName(
                    'film_category',
                    'catefory_id',
                    'category',
                    'category_id'
                ),
                'category_id',
                $setup->getTable('category'),
                'category_id'
            )
            -> addForeignKey(
                $setup->getFkName(
                    'film_category',
                    'film_id',
                    'film',
                    'film_id'
                ),
                'film_id',
                $setup->getTable('film'),
                'film_id'
            );
        $setup->getConnection()->createTable($table);
    }
}

