<?php

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class JsonForm extends Model{
    public $authToken;
    public $requestType;
    public $jsonData;

    private $_user;

    const GET = 1;
    const POST = 2;
    const REQUEST_TYPE = [self::GET => 'GET', self::POST => 'POST'];

    public function rules() {
        return [
            [['authToken', 'requestType'], 'required'],
            ['jsonData','file', 'extensions' => ['json'], 'maxSize'=>1024 * 1024 * 2, 'tooBig'=> 'Максимальный размер файла 2MB'],
            ['requestType', 'in', 'range' => array_keys(self::REQUEST_TYPE)],
//            ['authToken', 'validateToken', 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

    public function validateToken($attribute, $params) {
        $user = $this->getUserByConsoleToken();
        if(!$user) {
            $this->addError($attribute, 'Token has been expired or invalid.');
            return false;
        }
        return true;

    }

    protected function getUserByConsoleToken() {
        if ($this->_user === null) {
            $this->_user = User::findByConsoleAuthToken($this->authToken);
        }
        return $this->_user;
    }
}