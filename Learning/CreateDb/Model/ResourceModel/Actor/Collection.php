<?php
namespace Learning\CreateDb\ResourceModel\Actor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\HelloWorld\Model\Actor as Model;
use Magestore\HelloWorld\Model\ResourceModel\Actor as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

