<?php

namespace app\controllers;

use app\models\Expert;
use sizeg\jwt\JwtHttpBearerAuth;
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

}