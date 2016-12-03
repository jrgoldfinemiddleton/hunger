<?php

namespace AppBundle\Util;


use Mockery\Mock;

class DataValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testOnlyValidStateAbbreviationsAllowed()
    {
        $abbrs = [
            'CA'    => true,
            'CV'    => false,
            'Ca'    => false,
            'Cv'    => false,
            ''      => false,
            'MAS'   => false,
            'PR'    => true,
            2       => false,
        ];

        foreach ($abbrs as $key => $val) {
            $this->assertEquals(DataValidator::isValidStateAbbr($key), $val);
        }
    }

    public function testEnsureValidPhoneStringsCanBeNormalized()
    {
        $phoneNos = [
            '(123) 456-7890',
            '1234567890',
            '858-693-2356',
            '(456)  345 2432',
        ];

        foreach ($phoneNos as $no) {
            $this->assertTrue(strlen(DataValidator::normalizePhone($no)) === 10,
                'Input has incorrect number of digits: ' . $no);
            $this->assertTrue(strlen(DataValidator::normalizePhone($no)) === strlen($no) -
                strlen(preg_replace('/[0-9]/', '', $no)),
                'Output has incorrect number of digits for input: ' . $no);

        }
    }

    public function testZipCodeValidation()
    {
        $zips = [
            '92111',
            '432344',
            '-13434',
            '-1234',
            '  34323',
            '',
            '3434A',
            null
        ];

        $this->assertTrue(DataValidator::isValidZip($zips[0]));
        $this->assertFalse(DataValidator::isValidZip($zips[1]));
        $this->assertFalse(DataValidator::isValidZip($zips[2]));
        $this->assertFalse(DataValidator::isValidZip($zips[3]));
        $this->assertFalse(DataValidator::isValidZip($zips[4]));
        $this->assertFalse(DataValidator::isValidZip($zips[5]));
        $this->assertFalse(DataValidator::isValidZip($zips[6]));
        $this->assertFalse(DataValidator::isValidZip($zips[7]));
    }

    public function testUserListItemOwnedByUserIsOK()
    {
        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => null,));

        $mockList = \Mockery::mock('\AppBundle\Entity\UserList');
        $mockList->shouldReceive(array('getUser' => $mockUser));

        $this->assertTrue(DataValidator::validateUserAndUserListMatch($mockUser, $mockList));
    }

    public function testUserListItemNotOwnedByUserIsBad()
    {
        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => null,));

        $mockUser2 = \Mockery::mock('\AppBundle\Entity\User');

        $mockList = \Mockery::mock('\AppBundle\Entity\UserList');
        $mockList->shouldReceive(array('getUser' => $mockUser2));

        $this->assertFalse(DataValidator::validateUserAndUserListMatch($mockUser, $mockList));
    }

    public function testVoterDeniesDonorUserWithFoodBank()
    {
        $mockList = \Mockery::mock('\AppBundle\Entity\UserList');
        $mockList2 = \Mockery::mock('\AppBundle\Entity\UserList');

        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => $mockList2,));

        $this->assertFalse(DataValidator::validateUserAndUserListMatch($mockUser, $mockList));
    }

    public function testFoodBankListItemOwnedByUserIsOK()
    {
        $mockBank = \Mockery::mock('\AppBundle\Entity\FoodBank');

        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => $mockBank,));

        $mockList = \Mockery::mock('\AppBundle\Entity\UserList');
        $mockList->shouldReceive(array('getFoodBank' => $mockBank));

        $this->assertTrue(DataValidator::validateFoodBankUserAndListMatch($mockUser, $mockList));
    }

    public function testFoodBankListItemNotOwnedByUserIsBad()
    {
        $mockBank = \Mockery::mock('\AppBundle\Entity\FoodBank');
        $mockBank2 = \Mockery::mock('\AppBundle\Entity\FoodBank');

        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => $mockBank,));

        $mockList = \Mockery::mock('\AppBundle\Entity\UserList');
        $mockList->shouldReceive(array('getFoodBank' => $mockBank2));

        $this->assertFalse(DataValidator::validateFoodBankUserAndListMatch($mockUser, $mockList));
    }

    public function testVoterDeniesFoodBankUserWithoutFoodBank()
    {
        $mockUser = \Mockery::mock('\AppBundle\Entity\User');
        $mockUser->shouldReceive(array('getFoodBank' => null,));

        $this->assertFalse(DataValidator::validateFoodBankUserAndListMatch($mockUser, null));
    }
}
