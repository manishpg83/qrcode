<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'role_id')->hiddenInput(['value'=> 2])->label(false);?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dod')->widget(
      DatePicker::className(), [
        // inline too, not bad
         'inline' =>false, 
         // modify template for custom rendering
        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-M-d'
        ]
]);?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model,'photo')->fileInput(['maxlength' => true]) ?>
    <?php 
      if($model->photo){
        echo '<img src="' . \yii::$app->request->BaseUrl.'/upload/' .$model->photo.'" width="100px">';
        echo Html::a('Delete photo',['user/deletephoto','id'=>$model->id],['class'=>'btn btn-danger']).'<p>';
     }
    echo $form->field($model, 'status')
          ->checkBox(['label' => 'Active', 'uncheck' => 0, 'checked' => 1]); 

    echo $form->field($model, 'is_admin')
          ->checkBox(['label' => 'Administrator', 'uncheck' => 0, 'checked' => 1]); 
     ?>
     <!-- <div class="form-group">
        <label>Date-Of-Birth</label> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
