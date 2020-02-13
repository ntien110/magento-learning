<?php

namespace Learning\CreateDb\Controller\ShowData;

use Learning\CreateDb\Model\ResourceModel\Film\Collection as FilmCollection;
use Learning\CreateDb\Model\ResourceModel\Actor\Collection as ActorCollection;
use Learning\CreateDb\Model\ResourceModel\FilmActor\Collection as FilmActorCollection;
use Learning\CreateDb\Model\ResourceModel\FilmCategory\Collection as FilmCategoryCollection;
use Learning\CreateDb\Model\ResourceModel\Category\Collection as CategoryCollection;

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

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        FilmCollection $filmCollection,
        ActorCollection $actorCollection,
        CategoryCollection $categoryCollection,
        filmActorCollection $filmActorCollection,
        FilmCategoryCollection $filmCategoryCollection)
    {
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

        $films=$this->filmCollection->getFilms();


        foreach ($films as $film) {
            foreach ($film as $key => $value) {
                echo $key . ' : ' . $value. '</br>';
            }
            echo '<br/><br/>';
        }
    }
}

