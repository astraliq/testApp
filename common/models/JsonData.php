<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "json_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $data
 * @property string|null $date_create
 * @property string|null $date_update
 */
class JsonData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'json_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'data'], 'required'],
            [['user_id'], 'integer'],
            [['data', 'date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'data' => 'Data',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
}