<?php
namespace Learning\CreateDb\Model\ResourceModel\Actor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\Actor as Model;
use Learning\CreateDb\Model\ResourceModel\Actor as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

