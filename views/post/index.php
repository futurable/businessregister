<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Company',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'tag',
            'business_id',
            'email:email',
            // 'employees',
            // 'active',
            // 'create_time',
            // 'bank_account_created',
            // 'openerp_database_created',
            // 'backend_user_created',
            // 'account_mail_sent',
            // 'token_key_id',
            // 'industry_id',
            // 'token_customer_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
