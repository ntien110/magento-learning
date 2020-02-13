<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Magestore\Model\Model\ResourceModel\Actor as ResourceModel;

class Actor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
