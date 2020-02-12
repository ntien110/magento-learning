<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Magestore\Model\Model\ResourceModel\Film_category as ResourceModel;

class Film_category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
