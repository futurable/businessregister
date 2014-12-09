<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    public function init()
    {
        parent::init();
        
        // Set the language
        if (isset($_GET['lang'])) {
            \Yii::$app->language = $_GET['lang'];
            \Yii::$app->session['lang'] = \Yii::$app->language;
        } 
        else if (isset(\Yii::$app->session['lang'])) 
        {
            \Yii::$app->language = \Yii::$app->session['lang'];
        }
    }
}

?>