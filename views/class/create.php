<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TesterClass */

$this->title = 'Create Tester Class';
$this->params['breadcrumbs'][] = ['label' => 'Tester Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tester-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
