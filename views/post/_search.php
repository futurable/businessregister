<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'tag') ?>

    <?= $form->field($model, 'business_id') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'employees') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'bank_account_created') ?>

    <?php // echo $form->field($model, 'openerp_database_created') ?>

    <?php // echo $form->field($model, 'backend_user_created') ?>

    <?php // echo $form->field($model, 'account_mail_sent') ?>

    <?php // echo $form->field($model, 'token_key_id') ?>

    <?php // echo $form->field($model, 'industry_id') ?>

    <?php // echo $form->field($model, 'token_customer_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
