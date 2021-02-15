<?php

namespace App\tests;


use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use witchy\phptool\tree\Unlimit;
use Monolog\Handler\StreamHandler;


class TreeTest extends TestCase
{
    public function testSum()
    {
        $obj = new Unlimit();
        $data = array(
            ['id' => 1, 'pid' => 0],
            ['id' => 2, 'pid' => 1],
            // ['id' => 3, 'pid' => 2],
            // ['id' => 4, 'pid' => 3],
            // ['id' => 5, 'pid' => 4],
            // ['id' => 6, 'pid' => 5],
        );
        var_dump($obj->category($data, 0));
        // array(1) {
        //     [0]=>
        //     array(3) {
        //       ["id"]=>
        //       int(1)
        //       ["pid"]=>
        //       int(0)
        //       ["child"]=>
        //       array(1) {
        //         [0]=>
        //         array(3) {
        //           ["id"]=>
        //           int(2)
        //           ["pid"]=>
        //           int(1)
        //           ["child"]=>
        //           array(0) {
        //           }
        //         }
        //       }
        //     }
        //   }
        // $this->Log()->error('category', $obj->category($data, 0));
    }

    public function Log()
    {
        // create a log channel
        $log = new Logger('Tester');
        $log->pushHandler(new StreamHandler(ROOT_PATH . 'storage/logs/app.log', Logger::WARNING));
        $log->error("Error");
        return $log;
    }
}
