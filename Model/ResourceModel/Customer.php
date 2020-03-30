<?php
namespace Magestore\Productmanager\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Vendor resource model
 */
class Customer extends AbstractDb
{


    protected function _construct()
    {
        $this->_init('customer_grid_flat', 'entity_id');
    }
}
