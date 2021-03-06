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
use app\models\BankAccount;
use app\models\BankUser;
use app\models\CompanySearch;
use app\models\Industry;

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

        if ( isset(Yii::$app->request->queryParams['company']) ){
            $searchTerm = Yii::$app->request->queryParams['company'];
            $search->searchTerm = $searchTerm;
        }
        if (isset(Yii::$app->request->bodyParams['Company'])) {
            $searchTerm = Yii::$app->request->bodyParams['Company']['searchTerm'];
            $search->searchTerm = $searchTerm;
        }
        
        if(!empty($search->searchTerm)){
        
            // Try to search by business ID
            $companies = $this->searchByBusinessID( $search->searchTerm  );
            
            // Nothing found by business ID. Try to search by name
            if($companies == false){
                $companies = $this->searchByName( $search->searchTerm );
            }
        }
        elseif(isset($search->searchTerm)) $search->addError('searchTerm', Yii::t('app', 'Search term can not be empty'));
        
        // Get bank accounts
        if(!empty($companies)) $companies = $this->getBankAccount($companies);
        
        return $this->render('index', [
            'search' => $search,
            'companies' => $companies,
        ]);
    }
    
    public function actionList()
    {
        $searchModel = new CompanySearch();
        
        if( isset( Yii::$app->request->queryParams['industry'] ) ){
            $industryID = Industry::find()->where([ 'name'=>Yii::$app->request->queryParams['industry'] ])->one()->id;
    
            $dataProvider = $searchModel->search(['CompanySearch'=>['industry_id'=>$industryID]]);
        } else $dataProvider = false;
        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
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
        ->limit(4)
        ->all();

        if(count($search) > 3){
            $company = new Company();
            
            $company->addError('searchTerm', Yii::t('app', "Too many results!")."<br/>".Yii::t('app', 'Try a more spesific search term.'));
            
            $result = [$company];
        }
        elseif(!empty($search)) $result = $search;
        else $result = false;
        
        return $result;
    }
    
    private function getBankAccount($companies){
        foreach($companies as $key => $company){
            $bankUser = BankUser::find()->where(['username'=>$company->tag])->one();
            $bankAccount = isset($bankUser) ? BankAccount::find()->where(['bank_user_id' => $bankUser->id])->one() : null;
            
            $companies[$key]->bank_account = $bankAccount;
        }
        
        return $companies;
    }
}
