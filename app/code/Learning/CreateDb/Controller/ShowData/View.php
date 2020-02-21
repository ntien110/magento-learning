<?php

namespace Learning\CreateDb\Controller\ShowData;

use Learning\CreateDb\Model\ResourceModel\Film\CollectionFactory as FilmCollectionFactory;
use Learning\CreateDb\Model\ResourceModel\Actor\Collection as ActorCollection;
use Learning\CreateDb\Model\ResourceModel\FilmActor\Collection as FilmActorCollection;
use Learning\CreateDb\Model\ResourceModel\FilmCategory\Collection as FilmCategoryCollection;
use Learning\CreateDb\Model\ResourceModel\Category\Collection as CategoryCollection;
use phpDocumentor\Reflection\Types\This;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $filmCollection;
    protected $actorCollection;
    protected $filmActorCollection;
    protected $filmCategoryCollection;
    protected $categoryCollection;
    protected $logger;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        FilmCollectionFactory $filmCollection,
        ActorCollection $actorCollection,
        CategoryCollection $categoryCollection,
        filmActorCollection $filmActorCollection,
        FilmCategoryCollection $filmCategoryCollection,
        \Learning\CreateDb\Logger\Logger $logger)
    {
        $this->logger=$logger;
        $this->filmCollection = $filmCollection;
        $this->actorCollection = $actorCollection;
        $this->filmActorCollection = $filmActorCollection;
        $this->filmCategoryCollection = $filmCategoryCollection;
        $this->categoryCollection = $categoryCollection;
        parent::__construct($context);
    }

    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->logger->info('Shown data');

//        print all record in Film table
//        echo "Films:<br>";
//
//        foreach($this->filmActorCollection as $film){
//            $data = $film->getData();
//            foreach ($data as $key => $value) {
//                echo $key . ' : ' . $value. '</br>';
//            }
//            echo '<br/><br/>';
//        }


//        $query= $this->filmCollection->getSelect()
//            ->joinLeft(
//                array('filmActor'=>'film_actor'),
//                'main_table.film_id=filmActor.film_id',
//                array('numberOfActor'=>'COUNT(actor_id)'))
//            ->having('numberOfActor >=5')
//            ->group('main_table.film_id');

//        get 5 film which have more than 5 actors
//        foreach ($this->filmCollection->create()->getFilmsHaveMoreThanFiveActors() as $film) {
//            foreach ($film->getData() as $key => $value) {
//                echo $key . ' : ' . $value. '</br>';
//            }
//            echo '<br/><br/>';
//        }

        foreach ($this->filmCollection->create()->getFilmsHaveTheMostActors() as $film) {
            foreach ($film->getData() as $key => $value) {
                echo $key . ' : ' . $value. '</br>';
            }
            echo '<br/><br/>';
        }


    }
}

