<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "moderator".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string|null $email
 * @property int|null $birthday
 * @property string|null $work_Experience
 * @property int|null $age
 * @property string|null $sex
 * @property string $login
 * @property string $pass
 * @property string|null $about
 *
 * @property Application[] $applications
 * @property DecisionCard[] $decisionCards
 */
class Moderator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moderator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday', 'age'], 'integer'],
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
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['id_Moderator' => 'id']);
    }

    /**
     * Gets query for [[DecisionCards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionCards()
    {
        return $this->hasMany(DecisionCard::className(), ['id_Moderator' => 'id']);
    }

    public static function getRandIdentified(){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($permitted_chars), 0, 11);
    }
}
