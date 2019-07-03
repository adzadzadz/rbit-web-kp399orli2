<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClassCarLocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Class Car Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

?>
<div class="class-car-location-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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
		
		<?php /*
		<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'trainer_id',
            // 'student_id',
            // 'class_id',
            // 'car_id',
            // 'locations_id',
            // 'status',
            'created_at',
            'updated_at',
        ],
		]) ?>
		
		*/ ?>

    <section id="mapWrap" style="height: 700px; width: 100%;">
        <div id="map" style="height: 100%; width: 100%;"></div>
    </section>
		
		<?php 
			$lastLoc = null;
			$count = 0;
			$speed = 0;
			$totalDistance = 0;
			foreach (json_decode($model->locs->data) as $loc) { 
				if ($lastLoc !== null) {
					// Calc distance
					$distance = haversineGreatCircleDistance($lastLoc->latitude, $lastLoc->longitude, $loc->latitude, $lastLoc->longitude);
					$totalDistance = $totalDistance + $distance;
					$time = (5000 / 60) / 60;
					$speed = $speed + (($distance * 1000) / $time);
				}
				$lastLoc = $loc;
				$count++;
			}
			$avgSpeed = $speed / $count;
		?>

    <section id="dataTable">
        <table class="table table-striped">
            <tr>
              <td width="50%"><strong>Average Speed</strong></td>
              <td width="50%"><strong><?= $avgSpeed ?> kmh</strong></td>  
            </tr>
						<tr>
							<td><strong>Total Distance</strong></td>
							<td><strong><?= $totalDistance ?> kms</strong></td>
						</tr>
        </table>
    </section>

    <section id="timeline">
      <h3>Notes</h3>
			<?php 
				foreach (json_decode($model->locs->data) as $loc) {
						if ($loc->note !== "null") {
							echo '<blockquote class="blockquote">';
								echo date('Y-M-D H:i:s', (int)$loc->epoch / 1000) . " - $loc->note";
							echo '</blockquote>';
						}
				}
				$avgSpeed = $speed / $count;
			?>
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
                    if ($key === \array_key_last($data)) {
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
