<?php

namespace Learning\CreateDb\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;

class Login extends Template
{
    private $session;

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
        return 'customer/Account/LoginPost';
    }

    public function login($email, $password)
    {
    }
}