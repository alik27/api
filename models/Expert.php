<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Array_;
use Yii;
use yii\helpers\ArrayHelper;

class Expert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday', 'age','activ'], 'integer'],
            [['login', 'pass'], 'required'],
            [['first_name', 'last_name', 'middle_name', 'email', 'work_Experience', 'sex', 'login', 'pass'], 'string', 'max' => 45],
            [['about'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'email' => 'Email',
            'birthday' => 'День рождения',
            'work_Experience' => 'Стаж',
            'age' => 'Возраст',
            'sex' => 'Пол',
            'login' => 'Логин',
            'pass' => 'Пароль',
            'about' => 'О себе',
            'activ' => 'вкл',
        ];
    }

    public static function getIn($query)
    {
      //  $a = ArrayHelper::remove($query[0], 'id');
        $a = ArrayHelper::remove($query[0], 'age');
        $a = ArrayHelper::remove($query[0], 'work_Experience');
        $a = ArrayHelper::remove($query[0], 'sex');
        $a = ArrayHelper::remove($query[0], 'login');
        $a = ArrayHelper::remove($query[0], 'pass');
       // $a = ArrayHelper::remove($query[0]['certificates'][0], 'id');
        $a = ArrayHelper::remove($query[0]['certificates'][0], 'id_Moderator');
        $a = ArrayHelper::remove($query[0]['certificates'][0], 'id_Expert');
        $a = ArrayHelper::remove($query[0]['certificates'][0], 'id_Decision_card');
        $a = ArrayHelper::remove($query[0]['certificates'][0], 'type');
       // $a = ArrayHelper::remove($query[0]['rating'][0], 'id');
        $a = ArrayHelper::remove($query[0]['rating'][0], 'id_Decision_card');
        return $query;
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['id_Expert' => 'id']);
    }

    /**
     * Gets query for [[DecisionCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDecision()
    {
        return $this->hasMany(DecisionCard::className(), ['id_Expert' => 'id']);
    }

    /**
     * Gets query for [[Estimations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstimations()
    {
        return $this->hasMany(Estimations::className(), ['id_Expert' => 'id']);
    }

    public function getCertificates(){
        return $this->hasMany(Files::className(), ['id_Expert' => 'id'])->andWhere(['files.type' => 1]);
    }
    public function getRating(){
        return $this->hasMany(Rating::className(), ['id_Decision_card' => 'id'])->viaTable('decision_card', ['id_Expert' => 'id']);
    }
}
