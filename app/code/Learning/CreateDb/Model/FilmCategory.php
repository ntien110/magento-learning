<?php

namespace Learning\CreateDb\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\CreateDb\Model\ResourceModel\FilmCategory as ResourceModel;

class FilmCategory extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
