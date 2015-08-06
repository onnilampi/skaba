#TODO
Users <--Jonne>  
	-Login
		- Login ohjaa nyt adminin /Admin ja käyttäjän /Events  
	-Autentikaatio  
		- UsersController::login tarkastaa käyttäjätunnuksen, mutta muille sivuille ei oo viel tehty mitään
	-Sivujen oikeudet 
	-Sessiot 
 
Events <--Onni>  
	-"Olin täällä"  
		-"Niin olit"/"etpäs ollut" T: ISOvastaava  
	-Tapahtuman lisääminen  
		-Adminin alle  
	-Luokka "tapahtuma", oliona tapahtuma, metodeina poisto ja lisäys  
	-Käyttäjän EventsControlleriin tapahtuma-olioiden hakeminen listaan  
		-funktio joka hakee halutut tapahtumat  
Guilds  
	-Kiltatason pisteet/tapahtumat  
		-käytetään hyväksi ylempänä olevia  
Leaderboard  
	-Toteutus  



# CakePHP Application Skeleton

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](http://cakephp.org) 3.0.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](http://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run
```bash
composer create-project --prefer-dist cakephp/app [app_name]
```

You should now be able to visit the path to where you installed the app and see
the setup traffic lights.

## Configuration

Read and edit `config/app.php` and setup the 'Datasources' and any other
configuration relevant for your application

.
