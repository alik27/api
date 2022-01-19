<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $id
 * @property int|null $criterion1
 * @property int|null $criterion2
 * @property int|null $criterion3
 * @property int|null $criterion4
 * @property int $id_Decision_card
 *
 * @property DecisionCard $decisionCard
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['criterion1', 'criterion2', 'criterion3', 'criterion4', 'id_Decision_card'], 'integer'],
            [['id_Decision_card'], 'required'],
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
            'criterion1' => 'Критерий 1',
            'criterion2' => 'Критерий 2',
            'criterion3' => 'Критерий 3',
            'criterion4' => 'Критерий 4',
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
}
