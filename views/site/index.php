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
    
        <p class="lead"><?= Yii::t('app', 'Search a company by business ID')?>:</p>
        
		<div class="company-form">
		
		    <?php
		    $form = ActiveForm::begin([
	            'id' => 'search-form',
	            'type' => ActiveForm::TYPE_INLINE
        	]);
		    ?>
		    
		    <?= $form->errorSummary($company); ?>
		
		   	<?= "<p>".$form->field($company, 'business_id')."</p>"; ?>
		
		    <div class="form-group">
		        <?= Html::submitButton(Yii::t('app', 'Search') , ['class' => 'btn btn-success']) ?>
		    </div>
		
		    <?php ActiveForm::end(); ?>
		
			<?php
				if( isset($company->business_id) ){
					echo "<h2>" . Yii::t('app', 'Search results') . ":</h2>";
				}
			
				if(isset($company->name)){
					$attributes = [
						'name',
						'business_id',
						'email:email',
						'employees',
	                    [
	                        'attribute' => 'industry.name',
	                        'label' => Yii::t('app', 'Industry'),
	                    	'value' => Yii::t('app', $company->industry->name),
	                    ],
					];
					
					echo DetailView::widget([
						'model' => $company,
						'attributes' => $attributes,
					]);
				} elseif( isset($company->business_id) ) {
					echo "<p><strong>" . Yii::t('app', "Nothing was found with business id '{business_id}'", ['business_id'=>$company->business_id]) . "</strong></p>";
				}
			?>
		
		</div>
    </div>
    
</div>
