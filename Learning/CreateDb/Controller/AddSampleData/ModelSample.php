<?php

namespace Learning\CreateDb\Controller\AddSampleData;

use Learning\CreateDb\Model\ResourceModel\Film as FilmModel;
use Learning\CreateDb\Model\ResourceModel\Actor as ActorModel;
use Learning\CreateDb\Model\ResourceModel\Film_actor as FilmActorModel;
use Learning\CreateDb\Model\ResourceModel\Film_category as FilmCategoryModel;
use Learning\CreateDb\Model\ResourceModel\Category as CategoryModel;

class ModelSample extends \Magento\Framework\App\Action\Action
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
        $result = $this->resultJsonFactory->create();
        $data = ['message' => 'Hello world!'];

        return $result->setData($data);

//        $date=new DataTime();
//        $sample=$this->film->create();
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
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at film'];
//            }
//            return $result->setData($data);
//        }
//
//
//        $sample=$this->actor->create();
//        for ($i=0;$i<10;$i++){
//            $sample->addData([
//                'first_name'=>"actor's first name $i",
//                'last_name'=>"actor's last name $i",
//                'created_at'=> $date->getTimestamp(),
//                'updated_at'=> $date->getTimestamp()
//            ]);
//
//            $savingResult=$sample->save();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at actor'];
//            }
//            return $result->setData($data);
//        }
//
//
//        $sample=$this->category->create();
//        for ($i=0;$i<5;$i++){
//            $sample->addData([
//                'name'=>"category $i",
//                'created_at'=> $date->getTimestamp(),
//                'updated_at'=> $date->getTimestamp()
//            ]);
//
//            $savingResult=$sample->save();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! at category'];
//            }
//            return $result->setData($data);
//        }
//
//
//        $sample=$this->filmActor->create();
//        for ($i=0;$i<20;$i++){
//            $sample->addData([
//                'actor_id'=>rand(0,9),
//                'film_id'=>rand(0,9)
//            ]);
//
//            $savingResult=$sample->save();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! film_actor'];
//            }
//            return $result->setData($data);
//        }
//
//
//        $sample=$this->filmCategory->create();
//        for ($i=0;$i<10;$i++){
//            $sample->addData([
//                'category_id'=>rand(0,4),
//                'film_id'=>$i
//            ]);
//
//            $savingResult=$sample->save();
//            if (!$savingResult){
//                $result = $this->resultJsonFactory->create();
//                $data = ['message' => 'FAILED!!! film_category'];
//            }
//            return $result->setData($data);
//        }
//
//
//
//        $result = $this->resultJsonFactory->create();
//        $data = ['message' => 'SUCCESS!!!'];
//
//        return $result->setData($data);
    }
}

