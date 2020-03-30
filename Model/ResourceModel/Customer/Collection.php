<?php
namespace Magestore\ProductManager\Model\ResourceModel\Customer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\ProductManager\Model\Customer as Model;
use Magestore\ProductManager\Model\ResourceModel\Customer as ResourceModel;

/**
 * student Collection
 */
class Collection extends AbstractCollection
{

    /**
     * Main table primary key field name
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';


    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
