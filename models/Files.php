<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int|null $id_Moderator
 * @property int|null $id_Expert
 * @property int|null $id_Decision_card
 * @property int $type
 * @property string|null $file_URL
 * @property string|null $about
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Moderator', 'id_Expert', 'id_Decision_card', 'type'], 'integer'],
            [['type'], 'required'],
            [['file_URL'], 'string', 'max' => 100],
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
            'id_Moderator' => 'Id Moderator',
            'id_Expert' => 'Id Expert',
            'id_Decision_card' => 'Id Decision Card',
            'type' => 'Type',
            'file_URL' => 'File Url',
            'about' => 'About',
        ];
    }
}
