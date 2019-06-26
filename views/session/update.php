<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClassCarLocation */

$this->title = 'Update Class Car Location: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Class Car Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="class-car-location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
