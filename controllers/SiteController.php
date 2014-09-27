<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\controllers\MainController;
use app\models\Company;
use yii\db\Command;

class SiteController extends MainController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
    	$company = new Company();
    	
    	if(isset(Yii::$app->request->bodyParams['Company'])){
    		$business_id = Yii::$app->request->bodyParams['Company']['business_id'];
    		// Strip anything but numbers
    		$company->business_id = preg_replace( '/[^0-9]/', '', $business_id);
    		// Add a dash before validation bit
    		if(strlen($company->business_id)>=8){
    			$company->business_id = substr($company->business_id, 0, -1) . "-" . substr($company->business_id, -1);
    		}
    		
    		// Search the company
    		$search = Company::find()->where(['business_id'=>$company->business_id])->one();
    		
    		$company = !empty($search) ? $search : $company;
    	}
    	
        return $this->render('index', ['company'=>$company]);
    }
}
