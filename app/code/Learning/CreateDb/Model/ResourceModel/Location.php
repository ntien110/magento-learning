<?php

namespace Learning\CreateDb\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Location extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('webpos_location', 'location_id');
    }
}

