<?php


namespace Learning\Student\Controller\test;

use Learning\Student\Api\StudentRepositoryInterface as StudentRepository;


class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $studentRepository;
    protected $logger;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        StudentRepository $studentRepository,
        \Learning\CreateDb\Logger\Logger $logger)
    {
        $this->logger = $logger;
        $this->studentRepository=$studentRepository;
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

