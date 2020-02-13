<?php
namespace Learning\CreateDb\ResourceModel\Film_actor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\HelloWorld\Model\Film_actor as Model;
use Magestore\HelloWorld\Model\ResourceModel\Film_actor as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

