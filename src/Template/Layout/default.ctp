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
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <span class="navbar-brand">ISOSKABA</span>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="/Events">LISÄÄ</a></li>
                    <li><a href="/Attendances/me">OMAT</a></li> 
                    <li><a href="/Guilds/Me">KILTA</a></li> 
                    <li><a href="/Leaderboard">LEADERBOARD</a></li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (is_null($this->request->session()->read('Auth.User.username'))) {
                        echo '<li><a href="/Users/Login">' . __('Kirjaudu sisään') . '</a></li>';
                    }
                    else { ?>
                    <li class="dropdown fat-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" id="userMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded ="true">
                            <?= $this->request->session()->read('Auth.User.username'); ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userMenu2">
                            <li><a href="/Users/Logout"><?= __('Kirjaudu ulos'); ?></a></li>
                        </ul>
                    </li>
                    <?php }; ?>   
                </ul>
            </div>
        </div>
    </nav>
    <div id="container-fluid">
        <div class="row"><?= $this->Flash->render() ?></div>
        <div id="content">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>
