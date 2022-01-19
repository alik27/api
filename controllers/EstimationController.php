<?php

namespace app\controllers;

use app\models\Files;
use app\models\UploadForm;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use app\models\DecisionCard;
use app\models\Estimations;
use yii\web\UploadedFile;

class EstimationController extends Controller
{
    public $modelClass = 'app\models\DecisionCard';

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
            'index' => ['GET'],
            'upload' => ['GET','POST'],
            'ref' => ['GET','POST'],
            'delete' => ['GET'],
        ];
    }

    public function actionDelete()
    {
        if(Yii::$app->request->get('id')){
            Estimations::deleteAll(['id'=>Yii::$app->request->get('id')]);
        }
    }

    public function actionRef()
    {
        if(Yii::$app->request->get('id')){
            $query = Estimations::findOne(Yii::$app->request->get('id'));
        }
        else{
            $query = new Estimations;
        }
            $query->id_Expert=Yii::$app->request->post('id_Expert');
            $query->id_Decision_card=Yii::$app->request->post('id_Decision_card');
            $query->save();

    }

    public function actionIndex()
    {
        $query = DecisionCard::find()->joinWith('reports');

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => 200,
            ]
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');
            $file = $model->upload();
            if ($file) {
                $up_file = new Files;
                $up_file->id_Decision_card = Yii::$app->request->get('id');
                $up_file->type = 3;
                $up_file->about = Yii::$app->request->post('about');
                $up_file->file_URL = $file;
                if($up_file->save()) {
                    return $this->asJson([
                        'success' => 'Файлы загружены',
                    ]);
                }
                else {
                    return $this->asJson([
                        'success' => 'Данные о файле не сохранились',
                    ]);
                }
            }else{
                return $this->asJson([
                    'success' => 'Файлы не были загружены',
                ]);
            }
        }else{
            return $this->asJson([
                'success' => 'Файлы не были получены',
            ]);
        }
    }

}