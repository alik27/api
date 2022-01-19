<?php

namespace app\controllers;

use app\models\Estimations;
use app\models\Expert;
use app\models\Files;
use app\models\ImageUploadForm;
use app\models\Rating;
use app\models\UploadForm;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\rest\Controller;
use yii\web\UploadedFile;
use app\models\DecisionCard;

class DecisionsController extends Controller
{
    public $modelClass = 'app\models\DecisionCard';

    /*public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    }*/

    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'decision' => ['GET'],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->request->post('title')){
            $query = DecisionCard::findOne(Yii::$app->request->get('id'));
            $query->title=Yii::$app->request->post('title');
            $query->themes=Yii::$app->request->post('themes');
            $query->description=Yii::$app->request->post('description');
            $query->efficiency=Yii::$app->request->post('efficiency');
            $query->type=Yii::$app->request->post('type');
            $model = new ImageUploadForm();
            $model->images = UploadedFile::getInstances($model, 'images');
            $file = $model->upload();
            if($file){
                unlink($query->image_URL);
                $query->image_URL=$file;
                $files = new Files;
                $files->id_Expert=$query->id_Expert;
                $files->id_Moderator=$query->id_Moderator;
                $files->type=2;
                $model = new UploadForm();
                $model->files = UploadedFile::getInstances($model, 'files');
                $file = $model->upload();
            }
            if($query->save()){
                return $this->asJson([
                    'success' => true,
                ]);
            }
            return $query->save();

        }else {
            $query = DecisionCard::find()
                ->select('decision_card.id,title,themes,description,efficiency,decision_card.image_URL
                ,company.id,company.entity,company.inn,company.link,company.email,company.tel,company.region,company.address,company.category,company.year_Foundation,company.number_Employees,company.sales,company.image_URL
                ,files.id,files.file_URL,files.about')
                ->andWhere(['decision_card.id' => Yii::$app->request->get('id'),])
                ->joinWith('companies')->joinWith('comment')->asArray()->limit(1)->one();

            return $query;
        }
    }

    public function actionDecision()
    {
        $query = DecisionCard::find()->select('decision_card.id,title,description,image_URL,')
            ->addSelect("CEILING(((SELECT COUNT(*) FROM rating WHERE decision_card.id = rating.id_Decision_card) /
(SELECT COUNT(*) FROM rating WHERE decision_card.id = rating.id_Decision_card))*100)  as rating")
            ->asArray()->groupBy('decision_card.id');

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 200,
            ]
        ]);
    }

}