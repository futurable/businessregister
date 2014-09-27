<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'business_id')->textInput(['maxlength' => 9]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'employees')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'bank_account_created')->textInput() ?>

    <?= $form->field($model, 'openerp_database_created')->textInput() ?>

    <?= $form->field($model, 'backend_user_created')->textInput() ?>

    <?= $form->field($model, 'account_mail_sent')->textInput() ?>

    <?= $form->field($model, 'token_key_id')->textInput() ?>

    <?= $form->field($model, 'industry_id')->textInput() ?>

    <?= $form->field($model, 'token_customer_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
