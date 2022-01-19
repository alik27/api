<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $type
 * @property int $id_Expert
 * @property int|null $isAccepted
 * @property int $id_Moderator
 * @property string|null $applicationcol
 *
 * @property Expert $expert
 * @property Moderator $moderator
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'id_Expert', 'id_Moderator'], 'required'],
            [['id_Expert', 'isAccepted', 'id_Moderator'], 'integer'],
            [['type', 'applicationcol'], 'string', 'max' => 45],
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
            'type' => 'Type',
            'id_Expert' => 'Id Expert',
            'isAccepted' => 'Is Accepted',
            'id_Moderator' => 'Id Moderator',
            'applicationcol' => 'Applicationcol',
        ];
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
}
