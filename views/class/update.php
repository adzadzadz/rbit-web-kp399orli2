<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesterClass */

$this->title = 'Update Tester Class: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tester Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tester-class-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
