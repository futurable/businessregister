<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/css/img/favicon.ico" />
    <?php $this->head()?>
</head>
<body>

<?php
NavBar::begin([
    'brandLabel' => Yii::t('app', 'Futurality Business Register'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top'
    ]
]);
echo Nav::widget([
    'options' => [
        'class' => 'navbar-nav navbar-right'
    ],
    'items' => [
        [
            'label' => 'Language',
            'items' => [
                [
                    'label' => 'Finnish',
                    'url' => Url::canonical() . '?lang=fi'
                ],
                [
                    'label' => 'English',
                    'url' => Url::canonical() . '?lang=en'
                ]
            ]
        ]
    ]
]);
NavBar::end();
?>

<?php $this->beginBody()?>
    <div class="wrap">
        <div class='disclaimer'>
            <p>
                Welcome to Futural - a virtual learning environment by <a
                    href='http://futurable.fi'>Futurable</a>. <a
                    href='http://futurable.fi/index.php/site/contact'>Give feedback</a>.
            </p>
        </div>

        <div class="container">
            <div id="logo">
                <?php echo Html::img( Yii::getAlias('@web') . "/css/img/businessregister_logo_". \Yii::$app->language .".png"); ?>
            </div>
            
<?php
NavBar::begin([
    #'brandLabel' => Yii::t('app', 'List by industry'),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar'
    ]
]);
echo Nav::widget([
    'options' => [
        'class' => 'navbar-nav'
    ],
    'items' => [
        [
            'label' => Yii::t('app', 'List by industry'),
            'items' => [
                [
                    'label' => Yii::t('app', 'computer-retail'),
                    'url' =>  ['/site/list', 'industry'=>'computer-retail'],
                ],
                [
                    'label' => Yii::t('app', 'computer-assembly'),
                    'url' => ['/site/list', 'industry'=>'computer-assembly'],
                ]
            ]
        ]
    ]
]);
NavBar::end();
?>
            
            <?= $content?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">Futural business simulation environment</p>
            <p class="pull-right">Futurable Oy <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
