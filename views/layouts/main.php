<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
    \ramosisw\CImaterial\web\MaterialAsset::register($this);
} else {
    AppAsset::register($this);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background: #fff;">
<?php $this->beginBody() ?>

<div class="wrap">
    
		<!-- 
			/user/registration/register Displays registration form
			/user/registration/resend Displays resend form
			/user/registration/confirm Confirms a user (requires id and token query params)
			/user/security/login Displays login form
			/user/security/logout Logs the user out (available only via POST method)
			/user/recovery/request Displays recovery request form
			/user/recovery/reset Displays password reset form (requires id and token query params)
			/user/settings/profile Displays profile settings form
			/user/settings/account Displays account settings form (email, username, password)
			/user/settings/networks Displays social network accounts settings page
			/user/profile/show Displays user's profile (requires id query param)
			/user/admin/index Displays user management interface
		 -->
    <nav class="navbar navbar-expand-lg bg-info">
			<div class="container-fluid">
				<div class="pull-left">
					<a class="navbar-brand" href="/">Car Tester</a>
				</div>
				<div class="pull-right">
				<ul class="nav justify-content-end">
				<?php if (!Yii::$app->user->isGuest) { ?>
					<li class="nav-item pull-right">
							<?= Html::a('Logout', Url::to(['/user/security/logout']), ['data-method' => 'POST', 'class' => 'nav-link active']); ?>
					</li>
					<li class="nav-item pull-right">
						<a class="nav-link" href="/car">Car</a>
					</li>
					<li class="nav-item pull-right">
						<a class="nav-link" href="/class">Class</a>
					</li>
					<li class="nav-item pull-right">
						<a class="nav-link" href="/user/admin">Users</a>
					</li>
					<li class="nav-item pull-right">
						<a class="nav-link" href="/user/settings/profile">My Profile</a>
					</li>
					<li class="nav-item pull-right">
						<a class="nav-link" href="/session">Dashboard</a>
					</li>
					<?php } else { ?>
						<li class="nav-item pull-right">
							<?= Html::a('Login', Url::to(['/user/security/login']), ['data-method' => 'POST', 'class' => 'nav-link active']) ?>
						</li>
					<?php } ?>
				</ul>
				</div>
			</div>
    </nav>
    <section class="col-md-12">
			<div class="container" style="padding: 50px">
				<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= $content ?>
			</div>
    </section>

</div>

<footer class="footer">
    <div class="container">
			<p class="pull-left">&copy; Car Tester <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
