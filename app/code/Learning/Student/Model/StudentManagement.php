<?php

namespace Learning\Student\Model;

class StudentManagement implements \Learning\Student\Api\StudentManagementInterface
{
    protected $collectionFactory;

    protected $resourceModel;
    protected $studentRepository;

    public function __construct(
        \Learning\Student\Model\ResourceModel\Student\CollectionFactory $collectionFactory,
        \Learning\Student\Model\ResourceModel\Student $resourceModel,
        \Learning\Student\Api\StudentRepositoryInterface $studentRepository
    )
    {

        $this->studentRepository=$studentRepository;
        $this->resourceModel=$resourceModel;
        $this->collectionFactory=$collectionFactory;
    }

}