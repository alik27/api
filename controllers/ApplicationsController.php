<?php

namespace app\controllers;

use app\models\Application;
use app\models\DecisionCard;
use app\models\Expert;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

class ApplicationsController extends Controller
{
    public $modelClass = 'app\models\Application';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        return $behaviors;
    }
    protected function verbs()
    {
        return [
            'experts' => ['GET'],
            'add' => ['POST'],
            'delete' => ['GET'],
        ];
    }

    public function actionExperts()
    {
        $query = Expert::find()
            ->select('expert.id,last_name,middle_name,first_name,work_Experience,age,decision_card.title,decision_card.themes,decision_card.efficiency,decision_card.description,decision_card.image_URL,decision_card.created_at')
            ->joinWith('decision')
            ->asArray();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 200,
            ]
        ]);
    }

    public function actionAdd()
    {
        if(Yii::$app->request->post('type')){
            $query = new Application;
            $query->type=Yii::$app->request->post('type');
            $query->id_Expert=Yii::$app->request->post('id_Expert');
           if($query->isAccepted) {$query->isAccepted=Yii::$app->request->post('isAccepted');}
            $query->id_Moderator=Yii::$app->request->post('id_Moderator');
            $query->applicationcol=Yii::$app->request->post('applicationcol');
            if($query->save()){
                return $this->asJson([
                    'success' => true,
                ]);
            }else {
                return $this->asJson([
                    'success' => false,
                ]);
            }
        }
    }
    public function actionDelete()
    {
        if(Yii::$app->request->get('id')){
            Application::deleteAll(['id'=>Yii::$app->request->get('id')]);
        }
    }

}