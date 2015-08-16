<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\userSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            //return ['id' => $model['id'], 'onclick' => 'location.href = "\'' . Url::to(['accountinfo/update']) . '?id=\'" + $(this).closest(\'tr\').data(\'id\')"'];
           // return ['id' => $model['id'], 'onclick' => 'alert('.$index.')'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'first_name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data['first_name']),'/user/view/'.$data['id']);
                },
            ],
            [
                'attribute' => 'last_name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data['last_name']),'/user/view/'.$data['id']);
                },
            ],
            'email:email',
            [
                'value' => 'birth_date',
                'attribute' => 'birth_date',
                'format' => 'date',
                'label' => $searchModel->getAttributeLabel('birth_date'),
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'birth_date',
                    'name'=>'birth_date',
                    'options' => ['placeholder' => 'Select a range'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]),
            ],
            [
                'label' => $searchModel->getAttributeLabel('avatar'),
                'format' => 'html',
                'value' => function($data) { return $data['avatar'] ? Html::img(Yii::getAlias(Yii::$app->params['imageWebPath'] . $data['id']) . '/' .$data['avatar'] . '_s.jpg')  : ''; },

            ],
            [
                'value' => 'registered_at',
                'attribute' => 'registered_at',
                'format' => 'date',
                'label' => $searchModel->getAttributeLabel('registered_at'),
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'registered_at',
                    'name'=>'registered_at',
                    'options' => ['placeholder' => 'Select a range'],
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ]),
            ],
            // 'active',


        ],
    ]); ?>

</div>
