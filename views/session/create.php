<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClassCarLocation */

$this->title = 'Create Class Car Location';
$this->params['breadcrumbs'][] = ['label' => 'Class Car Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-car-location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
