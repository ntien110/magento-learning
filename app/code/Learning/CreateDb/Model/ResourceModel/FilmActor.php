<?php

namespace Learning\CreateDb\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FilmActor extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('film_actor', 'id');
    }
}

