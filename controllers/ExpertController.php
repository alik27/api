<?php

namespace app\controllers;

use app\models\Application;
use app\models\Estimations;
use app\models\Rating;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use app\models\Expert;

class ExpertController extends Controller
{
    public $modelClass = 'app\models\Expert';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'expert',
    ];

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
            'index' => ['GET','POST'],
            'list' => ['GET'],
            'yes' => ['GET'],
            'no' => ['GET'],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->request->post('first_name')){
            $query = Expert::findOne(Yii::$app->request->get('id'));
            $query->first_name=Yii::$app->request->post('first_name');
            $query->middle_name=Yii::$app->request->post('middle_name');
            $query->last_name=Yii::$app->request->post('last_name');
            $query->email=Yii::$app->request->post('email');
            $query->birthday=Yii::$app->request->post('birthday');
            $query->about=Yii::$app->request->post('about');
            return $query->save();
        }else {
            $query = Expert::find()
                ->andWhere(['expert.id' => Yii::$app->request->get('id')])
                ->joinWith('certificates')
                ->joinWith('rating')
                ->asArray()->all();

            $all_act = Estimations::find()->count();
            $act = Expert::find()->andWhere(['expert.id' => Yii::$app->request->get('id')])->joinWith('estimations')->count();

            $activity = ($all_act/$act)*100;
            $query[0]['activity'] = $activity;

            return Expert::getIn($query);
        }
    }

    public function actionList()
    {
        $query = Expert::find()->select('expert.id,last_name,middle_name,first_name,work_Experience,about,application.applicationcol')
            ->joinWith('applications')->asArray();

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 200,
            ]
        ]);
    }
    public function actionYes()
    {
        $query = Application::updateAll(['isAccepted' => 1], ['id_Expert' =>Yii::$app->request->get('id')]);

        if($query) {
            return $this->asJson([
                'success' => 'Активация эксперта',
            ]);
        }
        else{
            return $this->asJson([
                'success' => 'Активация не произведена',
            ]);
        }
    }
    public function actionNo()
    {
        $query = Application::updateAll(['isAccepted' => 0], ['id_Expert' =>Yii::$app->request->get('id')]);

        if($query) {
            return $this->asJson([
                'success' => 'Отклонение активации эксперта',
            ]);
        }
        else{
            return $this->asJson([
                'success' => 'Отклонение активации эксперта не произведено',
            ]);
        }
    }

}