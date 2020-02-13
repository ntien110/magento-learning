<?php
namespace Learning\CreateDb\Model\ResourceModel\Location;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\Location as Model;
use Learning\CreateDb\Model\ResourceModel\Location as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

