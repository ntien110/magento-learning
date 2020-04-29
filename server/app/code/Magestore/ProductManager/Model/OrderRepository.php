<?php
namespace Magestore\ProductManager\Model;

use \Magestore\ProductManager\Api\OrderRepositoryInterface;
use \Magestore\ProductManager\Helper\Data as DataHelper;

class OrderRepository implements OrderRepositoryInterface{
    /**
     * @var \Magestore\ProductManager\Helper\Data
     */
    protected $dataHelper;

    /**
     * OrderRepository constructor.
     *
     * @param DataHelper $dataHelper
     */
    public function __construct(DataHelper $dataHelper){
        $this->dataHelper = $dataHelper;
    }

    /**
     * @inheritDoc
     */
    public function create($orderData)
    {
        return $this->dataHelper->createMageOrder($orderData);
    }
}