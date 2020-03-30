<?php
namespace Magestore\ProductManager\Model;

use \Magestore\ProductManager\Api\ProductRepositoryInterface;

/**
 * Class ProductRepository
 *
 * @package Magestore\ProductManager\Model
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getImage($id)
    {
        $urls=[];
        $objectmanager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectmanager ->create('Magento\Catalog\Model\Product')->load($id);
        $productimages = $product->getMediaGalleryImages();
        foreach($productimages as $productimage)
        {
            $urls[] = $productimage['url'];
        }
        return $urls;
    }
}
