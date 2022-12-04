<?php

namespace console\controllers;

use common\models\LoginForm;
use common\models\User;
use yii\console\Controller;
use yii\helpers\Console;

class CronController extends Controller {
    public function actionGetToken($login, $password) {

        $model = new LoginForm([
            'username' => $login,
            'password' => $password,
            'rememberMe' => true,
        ]);

        if ($model->validate()) {
            $user = User::findByUsername($model->username);
            $user->generateConsoleAuthToken();
            if ($user->save()) {
                return $this->stdout("auth token:\n$user->console_auth_token\n", Console::FG_GREEN, Console::BOLD);
            }
        }

        return $this->stderr("Invalid login or password\n", Console::FG_RED, Console::BOLD);
    }
}