<?php

/**
 * Class HomePageCest
 */
class HomePageCest
{
    /**
     * Test Home page content
     *
     * @param AcceptanceTester $I
     */
    public function testHomePageContent(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('Upload json file', 'h1');
        $I->seeElement('#jsonFile');
        $I->click('Upload');
        $I->seeResponseCodeIs(200);
        $I->see('Please upload the file !');
    }
}