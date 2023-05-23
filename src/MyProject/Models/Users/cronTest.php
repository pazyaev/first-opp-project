<?php

namespace MyProject\Models\Users;

use MyProject\Services\Db;

class cronTest
{
    private const TABLE_NAME = 'cron_test';

     /** @var string */
     protected $createdAt;
    
    public function __constract()
    {
    }

    public function update()
    {
        $sql = 'UPDATE ' . self::TABLE_NAME . ' SET created_at = CURRENT_TIMESTAMP WHERE id = 1';

        $db = Db::getInstance();
        $db->query($sql, $param2values, static::class);
    }
}

$test = new cronTest();
$test->update();

