<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Register a new user in communecter');
$I->amOnPage('/ph/communecter#default.home');
$I->click(['class' => 'btn-register']);
$I->fillField('name','Citoyen Test');
$I->fillField('password','qwerty');

