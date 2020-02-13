<?php
namespace Learning\CreateDb\Model\ResourceModel\FilmCategory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\FilmCategory as Model;
use Learning\CreateDb\Model\ResourceModel\FilmCategory as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}

