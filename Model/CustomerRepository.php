<?php
namespace Magestore\ProductManager\Model;

use Magento\Customer\Api\Data\CustomerSearchResultsInterfaceFactory;
use Magestore\ProductManager\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magestore\ProductManager\Api\CustomerRepositoryInterfaceFactory;
use Magestore\ProductManager\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
/**
 * Class CustomerRepository
 *
 * @package Magestore\ProductManager\Model
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * @var \Magestore\ProductManager\Model\ResourceModel\Customer\CollectionFactory
     */
    protected $customerCollectionFactory;
    /**
     * @var \Magestore\ProductManager\Api\Data\CustomerSearchResultsInterface
     */
    protected $searchResultsFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    public function __construct(
        CustomerCollectionFactory $customerCollectionFactory,
        CustomerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
//        ?: $this->getCollectionProcessor();
    }

    /**
     * @inheritDoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Magestore\ProductManager\Model\ResourceModel\Customer\Collection $collection */
        $collection = $this->customerCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Magento\Customer\Api\Data\CustomerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
