<?php

namespace app\controllers;

use app\models\DecisionCard;
use app\models\Estimations;
use app\models\Rating;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\Controller;

class RatingController extends Controller
{
    /**
     * @inheritdoc
     */
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
            'add' => ['GET'],
            'delete' => ['GET'],
        ];
    }

    public function actionDelete()
    {
        if(Yii::$app->request->get('id')){
            Rating::deleteAll(['id'=>Yii::$app->request->get('id')]);
        }
    }

    public function actionAdd()
    {
        if(Yii::$app->request->post('id_Decision_card')){
            $query = new Rating;
            $query->criterion1=Yii::$app->request->post('criterion1');
            $query->criterion2=Yii::$app->request->post('criterion2');
            $query->criterion3=Yii::$app->request->post('criterion3');
            $query->criterion4=Yii::$app->request->post('criterion4');
            $query->id_Decision_card=Yii::$app->request->post('id_Decision_card');
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
}