<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\ClientGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <? //= Html::activeDropDownList($model, 'user_id',
  //    ArrayHelper::map(User::find()->all(), 'id', 'user_name')) ?>

    <?php
    // Find()->where(['role_id' => 3])
    $dataCategory=ArrayHelper::map(User::Find()->asArray()->where(['role_id' => 3])->all(), 'id', 'user_name');
    echo $form->field($model, 'user_id')->dropDownList($dataCategory, 
             ['prompt'=>'-Choose a Client-',
              'onchange'=>'              
                $.post( "'.Yii::$app->urlManager->createUrl('client/getslug').'&id="+$(this).val(), function( data ) {
                  $("#clientgroup-slug_url" ).val( data );
                });
            ']); 
 
   
    ?>
     <?= $form->field($model, 'slug_url')->textInput(['maxlength' => true, 'readonly' => 'readony']) ?>

    <?php  //$form->field($model, 'user_id')->dropDownList(\common\models\User::getClientList(false)); ?>   

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'group_email_template')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

   
    <?= $form->field($model, 'group_image')->fileInput(['maxlength' => true]) ?>
    <?php 
      if($model->group_image){
        echo '<img src="' . \yii::$app->request->BaseUrl.'/group_logo/' .$model->group_image.'" width="100px">';
        echo Html::a('Delete group_image',['client_group/deletegroup_image','id'=>$model->id],['class'=>'btn btn-danger']).'<p>';
     }
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
