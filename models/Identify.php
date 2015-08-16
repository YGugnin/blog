<?php

namespace app\models;

//app\models\gii\Users is the model generated using Gii from users table

use Yii;
use app\models\User as DbUser;

class Identify extends \yii\base\Object implements \yii\web\IdentityInterface {

    public $id;
    public $first_name;
    public $last_name;
    public $birth_date;
    public $avatar;
    public $registered_at;
    public $active;
    public $password;
    public $authKey;
    public $access_token;
    public $email;

    /**
    * @inheritdoc
    */
    public static function findIdentity($id) {
        $dbUser = DbUser::find()->where(["id" => $id, 'active' => 1])->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
    * @inheritdoc
    */
    public static function findIdentityByAccessToken($token, $userType = null) {

        $dbUser = DbUser::find()->where(["access_token" => $token, 'active' => 1])->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
    * Finds user by email
    *
    * @param  string $email
    * @return static|null
    */
    public static function findByEmail($email) {
        $dbUser = DbUser::find()->where(["email" => $email, 'active' => 1])->one();
        if (!count($dbUser)) {
            return null;
        }
        return new static($dbUser);
    }

    /**
    * @inheritdoc
    */
    public function getId() {
        return $this->id;
    }

    /**
    * @inheritdoc
    */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
    * @inheritdoc
    */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
    * Validates password
    *
    * @param  string  $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

}