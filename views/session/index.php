<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-car-location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Session', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'trainer_id',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->trainer->profile->name;
                }
            ],
            [
                'attribute' => 'student_id',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->student->profile->name;
                }
            ],
            [
                'attribute' => 'class_id',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->class->name;
                }
            ],
            [
                'attribute' => 'car_id',
                'value'=> function ($model, $key, $index, $grid){
                    return $model->car->name;
                }
            ],
            //'locations_id',
            //'status',
            [
                'attribute' => 'created_at',
                'value'=> function ($model, $key, $index, $grid){
                    return date("Y-m-d H:i:s", $model->created_at);
                }
            ]
            ,
            [
                'attribute' => 'updated_at',
                'value'=> function ($model, $key, $index, $grid){
                    return date("Y-m-d H:i:s", $model->updated_at);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
