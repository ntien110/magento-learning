<?php

namespace Learning\Student\Api;

use Magento\Tests\NamingConvention\true\mixed;

interface StudentManagementInterface
{
    /**
     * Save student info to database
     *
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function save(\Learning\Student\Api\Data\StudentInterface $student);

    /**
     * Get students that fit $searchCriteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * delete student fron database
     *
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return mixed
     */
    public function delete(\Learning\Student\Api\Data\StudentInterface $student);

}
