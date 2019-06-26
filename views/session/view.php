<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClassCarLocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Class Car Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="class-car-location-view">

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
            'trainer_id',
            'student_id',
            'class_id',
            'car_id',
            'locations_id',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <section id="mapWrap" style="height: 700px; width: 100%;">
        <div id="map" style="height: 100%; width: 100%;"></div>
    </section>

    <script>
        <?php $data = json_decode($model->locs->data); ?>
        var map;
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          
          center: {lat: <?= end($data)->latitude ?>, lng: <?= end($data)->longitude ?>},
          mapTypeId: 'terrain'
        });

        var flightPlanCoordinates = [
            <?php
                
                foreach ($data as $key => $value) { 
                    if ($key === array_key_last($data)) {
                        echo "{lat: $value->latitude, lng: $value->longitude}";
                    } else {
                        echo "{lat: $value->latitude, lng: $value->longitude},";
                    }
                } 
            ?>
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->params['gmapApiKey'] ?>&callback=initMap" async defer></script>

</div>
