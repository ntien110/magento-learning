<?php

namespace Learning\CreateDb\Controller\Login;

use Magento\Framework\Controller\ResultFactory;
//use Learning\CreateDb\Block\Login as LoginBlock;

class Login extends \Magento\Framework\App\Action\Action
{
    /**
     * Booking action
     *
     * @return void
     */
    //protected $loginHandler;
    public function __construct(
        \Magento\Framework\App\Action\Context $context
        //LoginBlock $loginHandler
    )
    {
        //$this->loginHandler=$loginHandler;
        parent::__construct($context);
    }

    public function execute()
    {
        echo 'halo';
// 1. POST request : Get booking data
        $post = (array)$this->getRequest()->getPost();

        if (!empty($post)) {
// Retrieve your form data
            $email = $post['email'];
            $password = $post['password'];

// Doing-something with...

// Display the succes form validation message
//            if ($this->loginHandler->login($email,$password)){
//                echo 'success!!!';
//            }
//            else{
//                echo 'failed';
//            }
            $this->messageManager->addSuccessMessage('GOT IT: '.$email." ".$password);

// Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/learning-magento');

            return $resultRedirect;
        }
// 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

?>