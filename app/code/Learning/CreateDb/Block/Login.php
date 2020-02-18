<?php

namespace Learning\CreateDb\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;

class Login extends Template
{
    protected $session;

    public function __construct(
        Template\Context $context,
        array $data = [],
        CustomerSession $session)
    {
        $this->session = $session;
        parent::__construct($context, $data);
    }

    public function isLoggedIn()
    {
        return $this->session->isLoggedIn();
    }

    public function getFormAction()
    {
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //instance of\Magento\Framework\App\ObjectManager
        $storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore();
        $linkUrl = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK);
        return $linkUrl.'test/Login/LoginPost';
    }

}