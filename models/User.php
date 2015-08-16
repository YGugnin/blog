<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $birth_date
 * @property string $avatar
 * @property string $registered_at
 * @property integer $active
 *
 * @property Post[] $posts
 */
class User extends \yii\db\ActiveRecord
{
    public $password_repeat;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'access_token'], 'required'],
            ['password', 'required', 'on' => 'register'],
            [['birth_date', 'registered_at'], 'safe'],
            [['active'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            ['avatar', 'file', 'extensions'=> 'jpg, gif, png'],
            [['password'], 'string', 'max' => 60],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'birth_date' => 'Birth Date',
            'avatar' => 'Avatar',
            'registered_at' => 'Registered At',
            'access_token' => 'Access Token',
            'active' => 'Active',
        ];
    }

    /**
     * Disable update fields
     * @return array
     */
    public function scenarios()
    {
        return array_merge(['update' => ['first_name','last_name','email','password','birth_date','avatar']], parent::scenarios());
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * hash password, access token and format birth date
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if ($this->password) {
                $this->setPassword($this->password);
            } else {
                unset($this->password);
            }
            if($this->birth_date){
                $this->birth_date = Yii::$app->formatter->asDate($this->birth_date, "yyyy-MM-dd");
            }
            return true;
        }else{
            return false;
        }
    }


}
