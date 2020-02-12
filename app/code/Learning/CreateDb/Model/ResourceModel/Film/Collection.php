<?php
namespace Learning\CreateDb\ResourceModel\Film;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magestore\HelloWorld\Model\Film as Model;
use Magestore\HelloWorld\Model\ResourceModel\Film as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

