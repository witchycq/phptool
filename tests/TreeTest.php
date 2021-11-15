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
            ['id' => 1, 'name' => '手机', 'pid' => 0],
            ['id' => 2, 'name' => 'ios', 'pid' => 1],
            ['id' => 3, 'name' => 'android', 'pid' => 1],
            ['id' => 4, 'name' => '电脑', 'pid' => 0],
            ['id' => 5, 'name' => 'window', 'pid' => 4],
            ['id' => 6, 'name' => 'mac', 'pid' => 4],
        );
        $tree = $obj->category($data, 0);
        $result = array(
            [
                'id' => 1, 'name' => '手机', 'pid' => 0, 'child' => [
                    ['id' => 2, 'name' => 'ios', 'pid' => 1],
                    ['id' => 3, 'name' => 'android', 'pid' => 1],
                ],
            ],
            [
                'id' => 4, 'name' => '电脑', 'pid' => 0, 'child' => [
                    ['id' => 5, 'name' => 'window', 'pid' => 4],
                    ['id' => 6, 'name' => 'mac', 'pid' => 4],
                ]
            ]
        );
        $this->Log()->info('phptool.category', $tree, true);
        $this->assertEquals($result, $tree);
    }

    public function Log()
    {
        // create a log channel
        $log = new Logger('PHPToolLog');
        $log->pushHandler(new StreamHandler(ROOT_PATH . 'storage/logs/app.log', Logger::INFO));
        $log->info('phptool.category');
        return $log;
    }
}
