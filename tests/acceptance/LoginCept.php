<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Login in communecter');
$I->amOnPage('/ph/communecter#default.home');
$I->click(['class' => 'btn-login']);
$I->fillField('email','sylvain.barbot@gmail.com');
$I->fillField('password','cobolisbad');
$I->click(['class' => 'loginBtn']);
$I->see('.dropdown-toggle');

