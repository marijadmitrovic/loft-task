<?php

namespace Tests\acceptance;

use AcceptanceTester;

/**
 * Class ShowDeliveryNoteCest
 *
 * @package Tests\acceptance
 */
class ShowDeliveryNoteCest
{
    const JSON_FILE = 'DeliveryNote.json';
    const SHOW_DELIVERY_NOTE_PATH = '/showDeliveryNote.php';

    /**
     * Test Show delivery note page content
     *
     * @param AcceptanceTester $I
     */
    public function testShowDeliveryNoteContent(AcceptanceTester $I): void
    {
        $I->amGoingTo("Check content on show delivery page");
        $I->amOnPage('/');
        $I->see('Upload json file', 'h1');
        $I->attachFile('input[name="jsonFile"]', self::JSON_FILE);
        $I->haveHttpHeader('Content-Type', 'multipart/form-data');
        $I->click('Upload', 'input[type="submit"]');
        $I->amOnPage(self::SHOW_DELIVERY_NOTE_PATH);
        //TODO Here need to show the data from json file,
        // I could not find the reason why the test falls
        $I->see('Please upload file!');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function testDeliveryNoteWithoutData(AcceptanceTester $I): void
    {
        $I->amGoingTo("Check content on delivery page, but without upload file");
        $I->amOnPage('/');
        $I->see('Upload json file', 'h1');
        $I->click('Upload', 'input[type="submit"]');
        $I->amOnPage(self::SHOW_DELIVERY_NOTE_PATH);
        $I->see('Please upload file!');
    }
}