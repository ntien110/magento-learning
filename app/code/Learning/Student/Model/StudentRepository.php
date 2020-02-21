<?php

namespace Learning\Student\Model;


class StudentRepository implements \Learning\Student\Api\StudentRepositoryInterface
{
    protected $collectionFactory;

    protected $resourceModel;

    protected $collectionProcessor;

    protected $searchResultsFactory;

    protected $student;

    public function __construct(
        \Learning\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Learning\Student\Model\ResourceModel\Student $resourceModel,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Learning\Student\Api\Data\StudentSearchResultsInterfaceFactory $searchResultsFactory,
        \Learning\Student\Api\Data\StudentInterface $student
    )
    {
        $this->searchResultsFactory=$searchResultsFactory;
        $this->resourceModel=$resourceModel;
        $this->collectionFactory=$collectionFactory;
        $this->collectionProcessor = $collectionProcessor;// ?: $this->getCollectionProcessor();
        $this->student = $student;
    }

    public function save(\Learning\Student\Api\Data\StudentInterface $student)
    {
        $this->resourceModel->save($student);
        return $student;
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
//        /** @var \Learning\Student\Model\ResourceModel\Student\Collection $collection */
//        $collection = $this->studentCollectionFactory->create();
//
//        $this->collectionProcessor->process($searchCriteria, $collection);
//
//        /** @var Data\StudentSearchResultsInterface $searchResults */
//        $searchResults = $this->searchResultsFactory->create();
//        $searchResults->setSearchCriteria($searchCriteria);
//        $searchResults->setItems($collection->getItems());
//        $searchResults->setTotalCount($collection->getSize());
//        return $searchResults;
        $searchResult = $this->searchResultsFactory->create();
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult->setSearchCriteria($searchCriteria);

        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        //var_dump($collection->getItems());die;
        return $searchResult;
    }

    public function delete(\Learning\Student\Api\Data\StudentInterface $student)
    {
        return $this->resourceModel->delete($student);
    }

//    private function getCollectionProcessor()
//    {
//        if (!$this->collectionProcessor) {
//            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
//                'Magento\Cms\Model\Api\SearchCriteria\BlockCollectionProcessor'
//            );
//        }
//        return $this->collectionProcessor;
//    }
}