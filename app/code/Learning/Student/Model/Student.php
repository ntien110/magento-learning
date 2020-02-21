<?php

namespace Learning\Student\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\Student\Model\ResourceModel\Student as ResourceModel;

class Student extends AbstractModel implements \Learning\Student\Api\Data\StudentInterface
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Learning\Student\Model\ResourceModel\Student $resource,
        \Learning\Student\Model\ResourceModel\Student\Collection $resourceCollection,
        array $data = [])
    {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data);

    }

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @param string $name
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @param string $class
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setClass($class)
    {
        return $this->setData('class', $class);
    }

    /**
     * @param string $university
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setUniversity($university)
    {
        return $this->setData('university', $university);
    }

    /**
     * @param int $id
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setStudentId($id)
    {
        return $this->setData('student_id', $id);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_getData('name');
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->_getData('class');
    }

    /**
     * @return string
     */
    public function getUniversity()
    {
        return $this->_getData('university');
    }

    /**
     * @return int
     */
    public function getStudentId()
    {
        return $this->_getData('student_id');
    }
}