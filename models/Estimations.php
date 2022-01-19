<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estimations".
 *
 * @property int $id
 * @property int $id_Expert
 * @property int $id_Decision_card
 *
 * @property DecisionCard $decisionCard
 * @property Expert $expert
 */
class Estimations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estimations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Expert', 'id_Decision_card'], 'required'],
            [['id_Expert', 'id_Decision_card'], 'integer'],
            [['id_Expert'], 'exist', 'skipOnError' => true, 'targetClass' => Expert::className(), 'targetAttribute' => ['id_Expert' => 'id']],
            [['id_Decision_card'], 'exist', 'skipOnError' => true, 'targetClass' => DecisionCard::className(), 'targetAttribute' => ['id_Decision_card' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_Expert' => 'Id Expert',
            'id_Decision_card' => 'Id Decision Card',
        ];
    }

    /**
     * Gets query for [[DecisionCard]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDecisionCard()
    {
        return $this->hasOne(DecisionCard::className(), ['id' => 'id_Decision_card']);
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
}
