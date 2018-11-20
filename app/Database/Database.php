<?php

namespace app\Database;

interface Database
{
    public function getPDO();
    public function query($statement, $one = false);
    public function prepare($statement, $attributes, $one = false);
    public function lastInsertId();
}
