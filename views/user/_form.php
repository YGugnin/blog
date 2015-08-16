<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->input('email', ['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_date')->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => 'dd-MM-yyyy']) ?>

    <?php if($model->avatar) echo Html::img(Yii::getAlias(Yii::$app->params['imageWebPath'] . $model->id) . '/' . $model->avatar . '_s.jpg'); ?>

    <?= $form->field($model, 'avatar')->fileInput()  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registration' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
