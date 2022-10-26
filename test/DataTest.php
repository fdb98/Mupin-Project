<?php
declare(strict_types=1);

namespace App\Test;

use PHPUnit\Framework\TestCase;
use App\Filter;

class DataTest extends TestCase
{

    /*public function testEmail($email, $expected) {
        $filter = new Filter();
       $this->assertEquals($expected, $filter->isEmail($email));
    }

    public function getDataInput() {
        return [
            ["foo@gmail.com", true],
            ["foo", false],
            ["foo@@gmail.com",false],
            ["foo@gmail..com",false]
            ];
    }*/
    
 /**
 * @dataProvider getDataInput
 */
    public function testFile($file, $expected){
        $filter = new Filter();
        $this->assertEquals($expected, $filter->isImage($file));
    }

    public function getDataInput() {
        return [
            ["image.png", true],
            ["another_image.jpg", true],
            ["notanimage", false],
            ["another_notimage.pdf",false],
            ["rtresa_png",false],
            ["rtresa.rtr.png",true]
            ];
    }

    /**
    * @dataProvider getTableInput
    */

    public function testTable($table, $expected){
        $filter = new Filter();
        $this->assertEquals($expected, $filter->isTable($table));
    }

    public function getTableInput() {
        return [
            ["computer", true],
            ["perifarica", false],
            ["Monitor", false],
            ["periferica",true],
            ["Webcam",false]
            ];
    }
}