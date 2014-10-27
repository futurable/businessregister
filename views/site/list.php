<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'List by industry');
$industry = isset( Yii::$app->request->queryParams['industry'] ) ? Yii::$app->request->queryParams['industry'] : Yii::t('app', 'No industry selected!');
?>
<div class="site-list">

    <div class="jumbotron">
        <h1><?= Yii::t('app', $industry); ?></h1>
    
        <?php 
        if($dataProvider){
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name' => [
                        'label' => Yii::t('app', 'Name'),
                        'format' => 'raw',
                        'value'=>function ($data) { return Html::a(Html::encode($data->name), ['index', 'company' => $data->business_id] ); },
                    ],
                    'business_id' => [
                        'label' => Yii::t('app', 'Business ID'),
                        'format' => 'raw',
                        'value'=>function ($data) { return Html::a(Html::encode($data->business_id), ['index', 'company' => $data->business_id] ); },
                    ],
                    'email:email',
                ],
            ]);
        }
        ?>
    </div>
    
</div>
