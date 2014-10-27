<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'List by industry');
?>
<div class="site-list">

    <div class="jumbotron">
        <h1><?= Yii::t('app', Yii::$app->request->queryParams['industry']); ?></h1>
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'name' => [
                    'format' => 'raw',
                    'value'=>function ($data) { return Html::a(Html::encode($data->name), ['index', 'company' => $data->business_id] ); },
                ],
                'business_id' => [
                    'format' => 'raw',
                    'value'=>function ($data) { return Html::a(Html::encode($data->business_id), ['index', 'company' => $data->business_id] ); },
                ],
                'email:email',
            ],
        ]); ?>
    </div>
    
</div>
