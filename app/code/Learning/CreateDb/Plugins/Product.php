<?php
namespace Learning\CreateDb\Plugins;

class Product
{
public function beforeSetData(\Magento\Catalog\Model\Product $subject, $data, $value = null)
{
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $requestInterface = $objectManager->get('Magento\Framework\App\RequestInterface');
    $controllerName = $requestInterface->getControllerName();
//    var_dump($controllerName);die;
    if (!$controllerName=='product' && isset($data['name'])) {
        $data['name'] = 'hhhhhhhhhhhhhhhh';
    } else {
        if ($data == 'name') {
            $value = 'hhhhhhhhhhhhhhhh';
        }
    }

    return [$data, $value];

}

//public function afterGetName(\Magento\Catalog\Model\Product $subject, $name)
//{
//    return $name.'-Added after';
//}

//    public function aroundGetName(\Magento\Catalog\Model\Product $subject, \closure $process)
//    {
//        return 'added before-'.$process().'-Added after';
//    }
}