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
  <title>
		ISOSKABA
		<!--
    <?= $cakeDescription ?>: 
		<?= $this->fetch('title') ?> 
		-->
  </title>
  <?= $this->Html->meta('icon') ?>

  <!--
	<?= $this->Html->css('base.css') ?>
  <?= $this->Html->css('cake.css') ?>
	-->
	<?= $this->Html->css('bootstrap.css') ?>
	<?= $this->Html->css('isoskaba.css') ?>
	<script src="js/bootstrap.min.js"></script>
  <script src="js/isoskaba.js"></script>		

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
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
					<li><a href="add_event.php">LISÄÄ</a></li>
					<li><a href="my_status.php">OMAT</a></li> 
					<li><a href="guild_status.php">KILTA</a></li> 
					<li><a href="leaderboard.php">KAIKKI</a></li> 
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="LOGIN"><!--<span class="glyphicon glyphicon-user"></span>--> Sign Up</a></li>
					<li><a href="SIGNUP"><!--<span class="glyphicon glyphicon-log-in"></span>--> Login</a></li>
				</ul>
			</div>
		</div>
	</nav>
  <!-- </header> -->
  <div id="container">

		 <!-- <div id="content"> --> 
	    <?= $this->Flash->render() ?>

	    <!-- <div class="row"> -->
        <?= $this->fetch('content') ?>
	    <!-- </div> -->
		<!-- </div> -->
    <footer>
    </footer>
  </div>
</body>
</html>
