<?php

namespace Learning\CreateDb\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Film extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('film', 'film_id');
    }
}

