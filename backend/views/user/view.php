<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

/*$this->title = $model->id;*/
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> 

<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'role_id',
            'user_name',
            'email:email',
            'password_hash',
            
            'dod',
            'about:ntext',
            [
                'attribute'=>'photo',
                'value'=>\yii::$app->request->BaseUrl.'/upload/' .$model->photo,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'is_admin',
             'status',
            /*'auth_key',*/
            
           /* 'password_reset_token',*/
            /*'username',*/
            /*'contact_person',
            'slug_url:url',
            'status',
            'created_at',
            'updated_at',*/
        ],
    ]) ?>

</div>
