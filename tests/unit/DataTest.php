<?php

require_once 'inc/config.php';
require_once 'inc/DataLoader.php';


class SampleTest extends \PHPUnit\Framework\TestCase {
    //

    public function __construct(){
        parent::__construct();
        $this->dlc = new DataLoader();

    }
    public function testTrueAssertsToFalse(){
        $this->assertFalse(false);
    }

    public function testLongestOpeningCrawl(){
        $actual = $this->dlc->longestOpeningCrawl();

        $this->assertEquals('Attack of the Clones', $actual());
    }

    public function testMostAppreadCharacter(){
        $actual = $this->dlc->mostAppreadCharacter();

        $this->assertEquals('C-3PO', $actual());
    }

    public function testMostAppreadSpeciesNumberOfElements(){
        $actual = $this->dlc->mostAppreadSpecies();
        $actual = $actual();

        //name, count
        $this->assertCount(2, $actual[0]);
    }

    public function testLargestVehiclePilotsNumberOfElements(){
        $actual = $this->dlc->largestVehiclePilots();
        $actual = $actual();

        //planet, pilots, countOfPilots
        $this->assertCount(3, $actual[0]);
    }


}