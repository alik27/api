<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "decision_card".
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string|null $themes
 * @property string|null $description
 * @property string|null $efficiency
 * @property string|null $image_URL
 * @property int $id_Moderator
 * @property int $id_Expert
 * @property int|null $created_at
 *
 * @property Company[] $companies
 * @property Estimations[] $estimations
 * @property Expert $expert
 * @property Moderator $moderator
 * @property Rating[] $ratings
 */
class DecisionCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'decision_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'title', 'id_Moderator', 'id_Expert'], 'required'],
            [['description'], 'string'],
            [['id_Moderator', 'id_Expert', 'created_at'], 'integer'],
            [['type', 'title', 'themes', 'efficiency', 'image_URL'], 'string', 'max' => 45],
            [['id_Moderator'], 'exist', 'skipOnError' => true, 'targetClass' => Moderator::className(), 'targetAttribute' => ['id_Moderator' => 'id']],
            [['id_Expert'], 'exist', 'skipOnError' => true, 'targetClass' => Expert::className(), 'targetAttribute' => ['id_Expert' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'title' => 'Название',
            'themes' => 'Тематика',
            'description' => 'Описание',
            'efficiency' => 'Эффективность',
            'image_URL' => 'Картинка',
            'id_Moderator' => 'Id Moderator',
            'id_Expert' => 'Id Expert',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::className(), ['id_Decision_card' => 'id']);
    }

    /**
     * Gets query for [[Estimations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstimations()
    {
        return $this->hasMany(Estimations::className(), ['id_Decision_card' => 'id']);
    }

    /**
     * Gets query for [[Expert]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExpert()
    {
        return $this->hasOne(Expert::className(), ['id' => 'id_Expert']);
    }

    /**
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(Moderator::className(), ['id' => 'id_Moderator']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRating()
    {
        return $this->hasMany(Rating::className(), ['id_Decision_card' => 'id']);
    }

    public function getComment(){
        return $this->hasMany(Files::className(), ['id_Decision_card' => 'id'])->andWhere(['files.type' => 2]);
    }
    public function getReports()
    {
        return $this->hasMany(Files::className(), ['id_Decision_card' => 'id'])->andWhere(['files.type' => 3]);
    }
}
