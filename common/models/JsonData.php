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
    public $preparedJsonArr = [];

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

    public function afterFind() {
        $this->data = $this->convertTypeValues($this->data);
        $this->preparedJsonArr = $this->prepareJsonDataArray($this->data);
        $this->data = json_encode($this->data);
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert) {
        $this->data = json_decode($this->data);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public static function convertTypeValues($array) {
        if (gettype($array) == 'array') {
            foreach ($array as $k => $v) {
                $array[$k] = self::convertTypeValues($v);
            }
            return $array;
        }
        $converted = \json_decode($array);
        return $converted ?? $array;
    }

    public static function prepareJsonDataArray($json): array {
        $keyCounter = 1;
        $newArr = [];
        if(is_array($json)) {
            foreach ($json as $key => $value) {
                $typeVal = gettype($value);
                if ($typeVal === "array") {
                    $newArr[] = [
                        'title' => "$key ($typeVal)",
                        'key' => $keyCounter++,
                        'folder' => true,
                        'children' => self::prepareJsonDataArray($value),
                    ];
                } else {
                    $val = is_bool($value) ? ($value ? 'true' : 'false') : $value;
                    $newArr[] = [
                        'title' => "$key ($typeVal): $val",
                        'key' => $keyCounter++,
                    ];
                }
            }
        } else {
            $newArr[] = [
                'title' => "empty array",
                'key' => $keyCounter++,
            ];
            return $newArr;
        }
        return $newArr;
    }
}