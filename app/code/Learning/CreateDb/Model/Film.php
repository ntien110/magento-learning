<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Magestore\Model\Model\ResourceModel\Film as ResourceModel;

class Film extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
