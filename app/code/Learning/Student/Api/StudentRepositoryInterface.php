<?php

namespace Learning\Student\Api;

interface StudentRepositoryInterface
{
    /**
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function save(\Learning\Student\Api\Data\StudentInterface $student);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return mixed
     */
    public function delete(\Learning\Student\Api\Data\StudentInterface $student);

}