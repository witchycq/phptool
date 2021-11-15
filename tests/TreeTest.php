<?php

namespace App\tests;

require_once __DIR__ . '/../vendor/autoload.php';
define("ROOT_PATH", dirname(__DIR__) . "/");

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use witchy\phptool\tree\Unlimit;
use Monolog\Handler\StreamHandler;


class TreeTest extends TestCase
{
    public function testUnlimit()
    {
        $obj = new Unlimit();
        $data = array(
            ['id' => 1, 'name' => '手机', 'p_id' => 0],
            ['id' => 2, 'name' => 'ios', 'p_id' => 1],
            ['id' => 3, 'name' => 'android', 'p_id' => 1],
            ['id' => 7, 'name' => '华为', 'p_id' => 3],
            ['id' => 4, 'name' => '电脑', 'p_id' => 0],
            ['id' => 5, 'name' => 'window', 'p_id' => 4],
            ['id' => 6, 'name' => 'mac', 'p_id' => 4],
        );


        /**
         * 获取指定结点的树状数据
         */
        $assert_data = array(
            [
                'id' => 1, 'name' => '手机', 'p_id' => 0,
                'children' => [
                    ['id' => 2, 'name' => 'ios', 'p_id' => 1],
                    [
                        'id' => 3, 'name' => 'android', 'p_id' => 1,
                        'children' => [
                            ['id' => 7, 'name' => '华为', 'p_id' => 3],
                        ]
                    ],
                ],
            ],
            [
                'id' => 4, 'name' => '电脑', 'p_id' => 0,
                'children' => [
                    ['id' => 5, 'name' => 'window', 'p_id' => 4],
                    ['id' => 6, 'name' => 'mac', 'p_id' => 4],
                ]
            ]
        );
        $result = $obj->tree($data, 0);
        $this->Log()->info('phptool.category', $result, true);
        $this->assertEquals($assert_data, $result);

        /**
         * 获取指定结点的所有子节点 包含自己
         */
        $getAllChild_result = $obj->getAllChild($data, 1);
        $this->Log()->info('phptool.getAllChild', $getAllChild_result, true);
        $this->assertEquals($getAllChild_result, [2, 3, 7]);

        /**
         * 获取指定结点的所有父节点 包含自己
         */
        $getParentByChild_result = $obj->getParentByChild($data, 6);
        $this->Log()->info('phptool.getParentByChild', $getParentByChild_result, true);
        $this->assertEquals($getParentByChild_result, [6, 4]);

        /**
         * 获取指定结点的一级结点数据
         */
        $one = $obj->getOne($data, 1);
        $this->Log()->info('phptool.getOne', $one, true);
        $this->assertEquals($one, [2, 3]);
    }

    public function Log()
    {
        // create a log channel
        $log = new Logger('PHPToolLog');
        $log->pushHandler(new StreamHandler(ROOT_PATH . 'storage/logs/app.log', Logger::INFO));
        return $log;
    }
}
