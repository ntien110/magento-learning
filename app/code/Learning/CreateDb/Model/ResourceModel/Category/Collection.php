<?php
namespace Learning\CreateDb\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\Category as Model;
use Learning\CreateDb\Model\ResourceModel\Category as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

