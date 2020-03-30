<?php
namespace Magestore\ProductManager\Api;

/**
 * Interface CustomerRepositoryInterface
 *
 * @package Magestore\ProductManager\Api
 */
interface CustomerRepositoryInterface
{
    /**
     * Get customer list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magestore\ProductManager\Api\Data\CustomerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}