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

    /**
     * Test Show delivery note page content
     *
     * @param AcceptanceTester $I
     */
    public function testShowDeliveryNoteContent(AcceptanceTester $I): void
    {

        $I->amGoingTo("Check content on show delivery page");
        $I->amOnPage('/');
        $I->click('#jsonFile');
        $I->attachFile('#jsonFile',self::JSON_FILE);
        $I->click('Upload');
        $I->amOnPage('/showDeliveryNote.php');
        $I->see('JSON does not validate. Violations:');
    }

}