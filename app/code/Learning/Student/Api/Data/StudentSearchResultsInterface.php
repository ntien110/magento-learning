<?php
namespace Learning\Student\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for student search results.
 * @api
 * @since o.o.1
 */
interface StudentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get students list.
     *
     * @return \Learning\Student\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * Set students list.
     *
     * @param \Learning\Student\Api\Data\StudentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
