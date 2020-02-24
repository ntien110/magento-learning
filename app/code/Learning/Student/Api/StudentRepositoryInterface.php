<?php

namespace Learning\Student\Api;

/**
 * Interface for StudentRepository
 *
 * @api
 * @since 0.0.1
 */
interface StudentRepositoryInterface
{
    /**
     * Save student to database
     *
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function save(\Learning\Student\Api\Data\StudentInterface $student);

    /**
     * Get list of students which fit the search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete student with id
     *
     * @param int $id
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function delete(int $id);
}
