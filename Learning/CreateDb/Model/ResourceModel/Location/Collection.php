<?php
namespace Learning\CreateDb\ResourceModel\Location;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\HelloWorld\Model\Location as Model;
use Magestore\HelloWorld\Model\ResourceModel\Location as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

