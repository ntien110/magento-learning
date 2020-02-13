<?php

namespace Learning\CreateDb\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Actor extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('actor', 'actor_id');
    }
}

