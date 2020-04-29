<?php
namespace Magestore\ProductManager\Api\Data;

/**
 * Interface CustomerSearchResultsInterface
 *
 * @package Magestore\ProductManager\Api\Data
 */
interface CustomerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return \Magestore\ProductManager\Api\Data\CustomerInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \Magestore\ProductManager\Api\Data\CustomerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
