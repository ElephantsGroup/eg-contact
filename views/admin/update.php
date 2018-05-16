<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model elephantsGroup\contact\models\ContactUs */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contact Us',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact uses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contact-us-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
