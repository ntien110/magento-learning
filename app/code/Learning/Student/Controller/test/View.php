<?php

namespace Learning\Student\Controller\test;

class View extends \Magento\Framework\App\Action\Action
{
    protected $studentRepository;

    protected $logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Learning\Student\Api\StudentRepositoryInterface $studentRepository
     * @param \Learning\CreateDb\Logger\Logger $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Learning\Student\Api\StudentRepositoryInterface $studentRepository,
        \Learning\CreateDb\Logger\Logger $logger)
    {
        $this->logger = $logger;
        $this->studentRepository = $studentRepository;
        parent::__construct($context);
    }

    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->logger->info('testing StudentInterface');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $student = $objectManager->create('\Learning\Student\Api\Data\StudentInterface');
        $student->setName("testName");
        $student->setClass("testClass");
        $student->setUniversity("testUniversity");
        $this->studentRepository->save($student);
        echo 'ok';
    }
}

