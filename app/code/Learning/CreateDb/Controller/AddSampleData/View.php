<?php

namespace Learning\CreateDb\Controller\AddSampleData;

use \Datetime;
use Learning\CreateDb\Model\Film as FilmModel;
use Learning\CreateDb\Model\Actor as ActorModel;
use Learning\CreateDb\Model\FilmActor as FilmActorModel;
use Learning\CreateDb\Model\FilmCategory as FilmCategoryModel;
use Learning\CreateDb\Model\Category as CategoryModel;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    protected $film;
    protected $actor;
    protected $filmActor;
    protected $filmCategory;
    protected $category;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        FilmModel $film,
        ActorModel $actor,
        CategoryModel $category,
        filmActorModel $filmActor,
        FilmCategoryModel $filmCategory)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->film = $film;
        $this->actor = $actor;
        $this->filmActor = $filmActor;
        $this->filmCategory = $filmCategory;
        $this->category = $category;
        parent::__construct($context);
    }

    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $date=new DateTime();
//        $sample=$this->film;
//        for ($i=0;$i<10;$i++){
//            $sample->addData([
//                'title'=>"title $i",
//                'description'=>"description for film $i",
//                'language_id'=>rand(10,14),
//                'original_language_id'=>rand(10,14),
//                'rental_duration'=>rand(10,20),
//                'rental_rate'=>rand(10,100)/10,
//                'length'=> rand(10,100),
//                'replacement_cost'=> rand(10,100)/10,
//                'created_at'=> $date->getTimestamp(),
//                'updated_at'=> $date->getTimestamp()
//            ]);
//
//            $savingResult=$sample->save();
//            $sample->unsetData();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at film'];
//                return $result->setData($data);
//            }
//        }
//
//
//        $sample=$this->actor;
//        for ($i=0;$i<10;$i++){
//            $sample->addData([
//                'first_name'=>"actor's first name $i",
//                'last_name'=>"actor's last name $i",
//                'created_at'=> $date->getTimestamp(),
//                'updated_at'=> $date->getTimestamp()
//            ]);
//
//            $savingResult=$sample->save();
//            $sample->unsetData();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at actor'];
//                return $result->setData($data);
//            }
//        }
//
//
//        $sample=$this->category;
//        for ($i=0;$i<5;$i++){
//            $sample->addData([
//                'name'=>"category $i",
//                'created_at'=> $date->getTimestamp(),
//                'updated_at'=> $date->getTimestamp()
//            ]);
//
//            $savingResult=$sample->save();
//            $sample->unsetData();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at category'];
//                return $result->setData($data);
//            }
//        }


//        $sample=$this->filmActor;
//        for ($i=0;$i<20;$i++){
//            $sample->addData([
//                'actor_id'=>rand(15,24),
//                'film_id'=>rand(16,21)
//            ]);
//            echo $sample->getData('actor_id');
//
//            $savingResult=$sample->save();
//            $sample->unsetData();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! film_actor'];
//                return $result->setData($data);
//            }
//        }


//        $sample=$this->filmCategory;
//        for ($i=0;$i<10;$i++){
//            $sample->addData([
//                'category_id'=>rand(10,14),
//                'film_id'=>$i+16
//            ]);
//
//            $savingResult=$sample->save();
//            $sample->unsetData();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! film_category'];
//                return $result->setData($data);
//            }
//        }



        $result = $this->resultJsonFactory->create();
        $data = ['message' => 'SUCCESS!!!'];

        return $result->setData($data);
    }
}

