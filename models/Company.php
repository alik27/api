<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $entity
 * @property string $inn
 * @property string $link
 * @property string $email
 * @property string|null $tel
 * @property string|null $region
 * @property string|null $address
 * @property string|null $category
 * @property string|null $year_Foundation
 * @property int $number_Employees
 * @property int $sales
 * @property string|null $image_URL
 * @property int $id_Product
 * @property int $id_Decision_card
 *
 * @property DecisionCard $decisionCard
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity', 'inn', 'link', 'email', 'number_Employees', 'sales', 'id_Product', 'id_Decision_card'], 'required'],
            [['number_Employees', 'sales', 'id_Product', 'id_Decision_card'], 'integer'],
            [['entity', 'inn', 'link', 'email', 'tel', 'region', 'address', 'category', 'year_Foundation', 'image_URL'], 'string', 'max' => 45],
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
            'entity' => 'Entity',
            'inn' => 'Inn',
            'link' => 'Link',
            'email' => 'Email',
            'tel' => 'Tel',
            'region' => 'Region',
            'address' => 'Address',
            'category' => 'Category',
            'year_Foundation' => 'Year Foundation',
            'number_Employees' => 'Number Employees',
            'sales' => 'Sales',
            'image_URL' => 'Image Url',
            'id_Product' => 'Id Product',
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
