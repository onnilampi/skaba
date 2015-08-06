<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISOSKABA</title>
    <?= $this->Html->meta('icon') ?>
    
    <!--
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
	-->
	<?= $this->Html->css('bootstrap.css') ?>
	<?= $this->Html->css('isoskaba.css') ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('isoskaba.js') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?php use Cake\Network\Http\Auth; ?>
</head>
<body>
	<!-- <header> -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="index.php">ISOskaba</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="/Events">LISÄÄ</a></li>
					<li><a href="/Users/me">OMAT</a></li> 
					<li><a href="/Guilds">KILLAT</a></li> 
					<li><a href="/Leaderboard">KAIKKI</a></li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if (isset($user)) {
                        echo '<li><a href="/Users/Logout">' . __('Kirjaudu ulos') . '</a><li>';
                    }
                    else {
                       echo  '<li><a href="/Users/Login">' . __('Kirjaudu sisään') . '</a></li>';
                    } ?>
				</ul>
			</div>
		</div>
	</nav>
    <!-- </header> -->
    <div id="container-fluid">

		<!-- <div id="content"> --> 
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                <?= $this->Flash->render() ?>
            </div>
        </div>
            <?= $this->fetch('content') ?>
    <footer>
    </footer>
    </div>
</body>
</html>
