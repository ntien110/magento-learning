<?php
declare(strict_types=1);

namespace Magento\Catalog\Model;

use Magestore\ProductManager\Api\Data\CustomerSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Customer search results.
 */
class CustomerSearchResults extends SearchResults implements CustomerSearchResultsInterface
{
}
