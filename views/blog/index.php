<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\BaseStringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest){?>
    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php }?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'format' => 'html',
                'value' => function($data) { return $this->render('_user', [
                    'model' => $data,
                    'postfix' => 'm'
                ]); },

            ],
            [
                'format' => 'html',
                'attribute' => 'description',
                'label' => 'Content',
                'value' => function($data) { return '<h4>'.$data['title'].'</h4><div>'. (BaseStringHelper::truncate($data['description'], 100, '...', null, true )).'</div>'.Html::a('Read more...','/blog/view/'.$data['id']); },

            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'View'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return (!Yii::$app->user->isGuest && $model->user_id == Yii::$app->user->id) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'Update'),
                        ]) : '';
                    },
                    'delete' => function ($url, $model) {
                        return (!Yii::$app->user->isGuest && $model->user_id == Yii::$app->user->id) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => 'Delete',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) : '';
                    },
                ]
                //'template'=> function($data) {return '{view}'.((!Yii::$app->user->isGuest && $data['user_id'] == Yii::$app->user->id) ? ' {delete} {update}' : '');},

            ],
        ],
    ]); ?>

</div>
