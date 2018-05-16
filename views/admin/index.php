<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel vendor\elephantsGroup\contact\models\ContactUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact uses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-us-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Contact Us'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
            'user_id',
            'email',
            'subject',
            'description',
            'sort_order',
[
                'attribute' => 'status',
                'value' => function($model){
                    return elephantsGroup\contact\models\ContactUs::getStatus()[$model->status];
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', elephantsGroup\contact\models\ContactUs::getStatus(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'Select Status ...')])
            ],            'update_time',
            'creation_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
