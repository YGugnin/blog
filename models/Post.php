<?php

namespace app\models;

use Yii;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;


/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $user_id
 * @property string $created_at
 * @property integer $active
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord implements Linkable
{
    /**
     * Set fields
     * @return array fields
     */
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['user_id'], $fields['active']);
        return $fields;
    }

    /**
     * Set extra fields
     * @return array fields
     */
    public function extraFields()
    {
        $fields = parent::extraFields();
        $fields['user'] = function(){
            $user = $this->user;
            unset($user['password'], $user['access_token'], $user['active']);
            $user->avatar = $user->avatar ?  Url::to(Yii::getAlias(Yii::$app->params['imageWebPath'] . $this->user_id) . '/' .$user->avatar . '_b.jpg', true) : null;
            return $this->user;
        };
        return $fields;
    }

    /**
     * Set api links
     */
    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to([$this->id], true),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * Disable update fields
     * @return array
     */
    public function scenarios()
    {
        return array_merge(['update' => ['title','description']], parent::scenarios());
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user_id'], 'required'],
            [['id', 'created_at', 'user_id'], 'safe', 'except'=>'create'],
            [['description'], 'string'],
            [['user_id', 'active'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
