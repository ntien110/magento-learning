<?php
namespace Learning\Student\Model;

use Magento\Framework\Model\AbstractModel;
use Learning\Student\Model\ResourceModel\Student as ResourceModel;

/**
 * Student model
 *
 * @since 0.0.1
 */
class Student extends AbstractModel implements \Learning\Student\Api\Data\StudentInterface
{
    /**
     * Student resource constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ResourceModel $resource
     * @param ResourceModel\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Learning\Student\Model\ResourceModel\Student $resource,
        \Learning\Student\Model\ResourceModel\Student\Collection $resourceCollection,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data);
    }

    /**
     * secondary constructor
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * set student name
     *
     * @param string $name
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setName($name)
    {
        return $this->setData($this::NAME, $name);
    }

    /**
     * set student class
     *
     * @param string $class
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setClass($class)
    {
        return $this->setData($this::CLASS_NAME, $class);
    }

    /**
     * set student university
     *
     * @param string $university
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setUniversity($university)
    {
        return $this->setData($this::UNIVERSITY, $university);
    }

    /**
     * set student ID
     *
     * @param int $id
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function setStudentId($id)
    {
        return $this->setData($this::STUDENT_ID, $id);
    }

    /**
     * student name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_getData($this::NAME);
    }

    /**
     * student class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->_getData($this::CLASS_NAME);
    }

    /**
     * student university
     *
     * @return string
     */
    public function getUniversity()
    {
        return $this->_getData($this::UNIVERSITY);
    }

    /**
     * student ID
     *
     * @return int
     */
    public function getStudentId()
    {
        return $this->_getData($this::STUDENT_ID);
    }
}
