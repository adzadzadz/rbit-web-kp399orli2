<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Class Car Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-car-location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Class Car Location', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
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
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
