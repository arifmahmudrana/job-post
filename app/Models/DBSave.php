<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 3/28/17
 * Time: 12:06 PM
 */

namespace App\Models;


interface DBSave
{
    public function process();

    public function fire();

    public function save();

    public function insert();
}