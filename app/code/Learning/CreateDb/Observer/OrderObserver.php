<?php
namespace Learning\CreateDb\Observer;

use Magento\Framework\Event\ObserverInterface;

class OrderObserver implements ObserverInterface
{
    private $LogoutController;

    private $logger;

    private $customerSession;


    public function __construct(
        \Learning\CreateDb\Logger\Logger $logger,
        \Magento\Customer\Controller\Account\Logout $logoutController,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->customerSession=$customerSession;
        $this->logger=$logger;
        $this->logoutController=$logoutController;
        //Observer initialization code...
        //You can use dependency injection to get any class this observer may need.
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
//        $order = $observer->getData('order');
//        $redirectionUrl = $this->url->getUrl('customer/Account/Logout');
        $this->logger->info("caught place order event.");
//        $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();
        $this->LogoutController->execute();
//        $this->customerSession->logout();
        return $this;


    }
}