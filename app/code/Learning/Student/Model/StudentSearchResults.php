<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Learning\Student\Model;

use Learning\Student\Api\Data\StudentSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Block search results.
 */
class StudentSearchResults extends SearchResults implements StudentSearchResultsInterface
{
}
