<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Magestore\Model\Model\ResourceModel\Film_actor as ResourceModel;

class Film_actor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
