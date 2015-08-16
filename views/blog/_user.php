<?php
use yii\helpers\Html;
?>
<?php if($model->user->avatar){?>
    <div>
        <?= Html::img(Yii::getAlias(Yii::$app->params['imageWebPath'] . $model->user_id) . '/' .$model->user->avatar . '_'.$postfix.'.jpg');  ?>
    </div>
<?php }?>
<div>
    <?= Html::a(Html::encode($model->user->first_name . ' ' . $model->user->last_name),'/user/view/'.$model->user_id) ?>
</div>
<div class="time">
    <?= Yii::$app->formatter->format($model->created_at, 'datetime');?>
</div>