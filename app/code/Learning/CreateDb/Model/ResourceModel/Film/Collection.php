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

    public function getFilmsHaveMoreThanFiveActors()
    {
        $this->getSelect()
            ->joinLeft(
                array('filmActor'=>'film_actor'),
                'main_table.film_id=filmActor.film_id',
                array('numberOfActor'=>'COUNT(actor_id)'))
            ->having('numberOfActor >=5')
            ->group('main_table.film_id');
        return $this;
    }

    public function  getFilmsHaveTheMostActors($limit = 5){
        $this->getSelect()
            ->joinLeft(
                ['filmActor'=> 'film_actor'],
                'main_table.film_id=filmActor.film_id',
                ['numberOfActor'=>'Count(actor_id)'])
            ->group('main_table.film_id')
            ->order('numberOfActor DESC')
            ->limit($limit);
        return $this;
    }
}

