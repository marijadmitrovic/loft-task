<?php

class HomePageCest
{
    public function testHomePageContent(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Upload json file', 'h1');
        $I->seeElement('#jsonFile');
        $I->click('Upload');
        $I->seeResponseCodeIs(200);
        $I->see('Please upload the file !');
    }
}