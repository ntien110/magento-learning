<?php
namespace Learning\CreateDb\Model\ResourceModel\FilmActor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\FilmActor as Model;
use Learning\CreateDb\Model\ResourceModel\FilmActor as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

