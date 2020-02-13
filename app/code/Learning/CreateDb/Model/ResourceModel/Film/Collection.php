<?php
namespace Learning\CreateDb\Model\ResourceModel\Film;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Learning\CreateDb\Model\Film as Model;
use Learning\CreateDb\Model\ResourceModel\Film as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }

    public function getFilms()
    {
        $query= $this->getSelect()
            ->joinLeft(
                array('filmActor'=>'film_actor'),
                'main_table.film_id=filmActor.film_id',
                array('numberOfActor'=>'COUNT(actor_id)'))
            ->having('numberOfActor >=5')
            ->group('main_table.film_id');

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        return $connection->fetchAll($query);
    }
}

