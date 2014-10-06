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
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }

    public function actionIndex()
    {
        $search = new Company();
        $companies = [];
        
        if (isset(Yii::$app->request->bodyParams['Company'])) {
            $searchTerm = Yii::$app->request->bodyParams['Company']['searchTerm'];
            $search->searchTerm = $searchTerm;
            
            // Try to search by business ID
            $companies = $this->searchByBusinessID( $search->searchTerm  );
            
            // Nothing found by business ID. Try to search by name
            if($companies == false){
                $companies = $this->searchByName( $search->searchTerm );
            }
            
        }
        
        return $this->render('index', [
            'search' => $search,
            'companies' => $companies,
        ]);
    }
    
    private function searchByBusinessID($businessID){
        // Strip anything but numbers
        $businessID = preg_replace('/[^0-9]/', '', $businessID);
        
        // Add a dash before validation bit
        if (strlen($businessID) >= 8) {
            $businessID = substr($businessID, 0, - 1) . "-" . substr($businessID, - 1);
        }

        // Search the company
        $search = Company::find()
        ->where(['business_id' => $businessID])
        ->andWhere(['active' => 1])
        ->all();
        
        if(!empty($search)) $result = $search;
        else $result = false;
        
        return $result;
    }
    
    private function searchByName($name){
        // Search the company
        $search = Company::find()
        ->where(['like', 'LOWER(name)', strtolower($name)])
        ->andWhere(['active' => 1])
        ->limit(5)
        ->all();

        if(count($search) > 5) $result = Yii::t('app', "Too many results.")." ".Yii::t('app', 'Try more spesific search term');
        elseif(!empty($search)) $result = $search;
        else $result = false;
        
        return $result;
    }
}
