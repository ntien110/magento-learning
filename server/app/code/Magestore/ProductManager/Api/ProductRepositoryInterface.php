<?php
namespace Magestore\ProductManager\Api;

interface ProductRepositoryInterface
{
//    /**
//     * @return \Magento\Catalog\Api\Data\ProductInterface[]
//     */
//    public function getList();

    /**
     * @param int $id
     * @return string[]
     */
    public function getImage($id);
}