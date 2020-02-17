<?php

namespace Learning\CreateDb\Block;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class CategoryInfo extends Template
{
    private $registry;

    public function __construct(
        Template\Context $context,
        array $data = [],
        Registry $registry)
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }

    protected function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getProductCategory()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product=$this->getCurrentProduct();
        $categories=$product->getCategoryIds();
        $categoryNames=[];
        foreach($categories as $category){
            $categoryNames[] = $objectManager->create('Magento\Catalog\Model\Category')->load($category);
        }
        return $categoryNames;
    }
}