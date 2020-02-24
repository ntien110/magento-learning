<?php
namespace Learning\Student\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Student resource model
 *
 * @api
 * @since 0.0.1
 */
class Student extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('student', 'student_id');
    }
}