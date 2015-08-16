<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">
    <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->id == $model->user_id){?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php }?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-2">
            <?= $this->render('_user', [
                'model' => $model,
                'postfix' => 'm'
            ]) ?>
        </div>
        <div class="col post">
            <?= $model->description; ?>
        </div>
    </div>
</div>
