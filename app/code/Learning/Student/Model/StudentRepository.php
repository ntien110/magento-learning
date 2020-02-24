<?php
namespace Learning\Student\Model;

/**
 * Class StudentRepository
 */
class StudentRepository implements \Learning\Student\Api\StudentRepositoryInterface
{
    /**
     * @var ResourceModel\Student\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ResourceModel\Student
     */
    protected $resourceModel;

    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var \Learning\Student\Api\Data\StudentSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Learning\Student\Api\Data\StudentInterfaceFactory
     */
    protected $studentFactory;

    /**
     * StudentRepository constructor.
     * @param ResourceModel\Student\CollectionFactory $collectionFactory
     * @param ResourceModel\Student $resourceModel
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     * @param \Learning\Student\Api\Data\StudentSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Learning\Student\Api\Data\StudentInterfaceFactory $studentFactory
     */
    public function __construct(
        \Learning\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Learning\Student\Model\ResourceModel\Student $resourceModel,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Learning\Student\Api\Data\StudentSearchResultsInterfaceFactory $searchResultsFactory,
        \Learning\Student\Api\Data\StudentInterfaceFactory $studentFactory
    )
    {
        $this->studentFactory = $studentFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;// ?: $this->getCollectionProcessor();
    }

    /**
     * save student info
     *
     * @param \Learning\Student\Api\Data\StudentInterface $student
     * @return \Learning\Student\Api\Data\StudentInterface
     */
    public function save(\Learning\Student\Api\Data\StudentInterface $student)
    {
        $this->resourceModel->save($student);
        return $student;
    }

    /**
     * get list of students which fit the search criteria
     *
     * example: http://localhost/learning-magento/index.php/rest/V1/api/student/search?searchCriteria[filterGroups][0][filters][0][field]=name&searchCriteria[filterGroups][0][filters][0][value]=testing&searchCriteria[filterGroups][0][filters][0][conditionType]=like
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Learning\Student\Api\Data\StudentSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResult = $this->searchResultsFactory->create();
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * delete student with id
     *
     * @param int $id
     * @return \Learning\Student\Api\Data\StudentInterface|ResourceModel\Student|string
     */
    public function delete(int $id)
    {
        $student = $this->studentFactory->create()->load($id);
        if ($student->getId() == null) {
            return "Student with ID = $id do not exist.";
        }
        $this->resourceModel->delete($student);
        return $student;
    }
}
