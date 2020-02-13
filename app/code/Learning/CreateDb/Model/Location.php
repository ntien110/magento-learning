<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CreateDb\Model\ResourceModel\Location as ResourceModel;

class Location extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
