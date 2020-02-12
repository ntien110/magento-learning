<?php
namespace Learning\CreateDb\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\HelloWorld\Model\Category as Model;
use Magestore\HelloWorld\Model\ResourceModel\Category as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

