<?php
namespace Learning\Student\Model\ResourceModel\Student;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\Student\Model\Student as Model;
use Learning\Student\Model\ResourceModel\Student as ResourceModel;

/**
 * student Collection
 *
 * @api
 * @since 0.0.1
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
