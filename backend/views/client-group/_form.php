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
    <?php /*echo $form->field($model, 'user_id')
        ->dropDownList(
                       // Flat array ('id'=>'label')
            ['prompt'=>'']    // options
        );*/?>
    <?= Html::activeDropDownList($model, 'user_id',
      ArrayHelper::map(User::find()->all(), 'id', 'user_name')) ?>

    <?php
    $dataCategory=ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'user_name');
    echo $form->field($model, 'user_id')->dropDownList($dataCategory, 
             ['prompt'=>'-Choose a Client-',
              'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('client/getslug?id=').'"+$(this).val(), function( data ) {
                  $( "select#title" ).html( data );
                });
            ']); 
 
    $dataPost=ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'User');
    echo $form->field($model, 'user_id')
        ->dropDownList(
            $dataPost,           
            ['id'=>'title']
        );
    ?>

    <?php  //$form->field($model, 'user_id')->dropDownList(\common\models\User::getClientList(false)); ?>



    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'group_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'group_email_template')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput(['maxlength' => true]) ?>
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
