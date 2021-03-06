<?php
/**
 *
 * @author Yecheng Fu <cofyc.jackson@gmail.com>
 */

define('DB_SRC_PATH', realpath(dirname(__FILE__) . '/../src'));
set_include_path(DB_SRC_PATH . ':' . get_include_path());

require_once 'DB.php';
require_once 'DBTable.php';

DB::setConfig(array(
    'core' => array(
        'charset' => 'utf8'
    ),
    'global' => array(
        'mysql://root:root@127.0.0.1:3306/dbtest_global' => array(
            'settings'
        )
    ),
    'sharding' => array(
        'tables' => array(
            'user' => 1
        ),
        'masters' => array(
            1 => 'mysql://root:root@127.0.0.1:3306/dbtest_shard_index'
        ),
        'memcaches' => array(
            array(
                '127.0.0.1',
                11211
            )
        ),
        'clusters' => array(
            1 => array(
                1 => array(
                    'weight' => 10,
                    'dsn' => 'mysql://root:root@127.0.0.1:3306/dbtest_shard_1'
                ),
                2 => array(
                    'weight' => 0,
                    'dsn' => 'mysql://root:root@127.0.0.1:3306/dbtest_shard_2'
                ),
                3 => array(
                    'weight' => 30,
                    'dsn' => 'mysql://root:root@127.0.0.1:3306/dbtest_shard_3'
                )
            )
        )
    )
));

DBTable::setConfig(array(
    'memcaches' => array(
        array(
            '127.0.0.1',
            11211
        )
    )
));
