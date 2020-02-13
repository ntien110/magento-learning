<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CreateDb\Model\ResourceModel\FilmActor as ResourceModel;

class FilmActor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
