<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Futurality Business Register');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('app', 'Welcome!')?></h1>

        <p class="lead"><?= Yii::t('app', 'Search a company by the business ID or name')?>:</p>

        <div class="company-form">
        
            <?php
    $form = ActiveForm::begin([
        'id' => 'search-form',
        'type' => ActiveForm::TYPE_INLINE
    ]);
    ?>
            
            <?= $form->errorSummary($search); ?>
        
               <?= "<p>".$form->field($search, 'searchTerm')."</p>"; ?>
        
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Search') , ['class' => 'btn btn-success'])?>
            </div>
        
            <?php ActiveForm::end(); ?>
        
<?php
if (! empty($companies)) {
    echo "<h2>" . Yii::t('app', 'Search results') . ":</h2>";
}

if (! empty($companies)) {
    $i = 0;
    foreach ($companies as $company) {
        
        if ($company->hasErrors()) {
            echo "<h3>" . $company->getFirstError('searchTerm') . "</h3>";
            continue;
        }
        
        $i ++;
        $attributes = [
            'business_id',
            'email:email',
            'employees',
            [
                'attribute' => 'industry.name',
                'label' => Yii::t('app', 'Industry'),
                'value' => Yii::t('app', $company->industry->name)
            ]
        ];
        
        echo "<h3>{$company->name}</h3>";
        echo DetailView::widget([
            'model' => $company,
            'attributes' => $attributes
        ]);
    }
} elseif (isset($search->searchTerm) and ! empty($search->searchTerm)) {
    echo "<p><strong>" . Yii::t('app', "Nothing was found with the search term '{business_id}'", [
        'business_id' => $search->searchTerm
    ]) . "</strong></p>";
}
?>
        
        </div>
    </div>

</div>
