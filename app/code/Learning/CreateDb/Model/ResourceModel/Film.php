<?php

namespace Learning\CreateDb\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Location extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('film', 'film_id');
    }
}

