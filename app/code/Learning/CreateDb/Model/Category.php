<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CreateDb\Model\ResourceModel\Category as ResourceModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
