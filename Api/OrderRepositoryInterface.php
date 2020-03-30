<?php
namespace Magestore\ProductManager\Api;

/**
 * Interface OrderRepositoryInterface
 *
 * @package Magestore\ProductManager\Api
 */
interface OrderRepositoryInterface
{
    /**
     * @param mixed $orderData
     *
     * @return mixed
     */
    public function create($orderData);
}
