<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QrcodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qrcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qrcode-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qrcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'qrcode',
            'status',
            'used_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
