<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\user */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'email:email',
            'birth_date:date',
            [
                'attribute'=>'avatar',
                'value'=> $model->avatar ? Html::img(Yii::getAlias(Yii::$app->params['imageWebPath'] . $model->id) . '/' .$model->avatar . '_b.jpg')  : '',
                'format' => 'html',
            ],
            [
                'attribute'=>'access_token',
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->id ==  $model->id
            ],
            'registered_at',
        ],
    ]) ?>

</div>
