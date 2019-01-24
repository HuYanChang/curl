<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/24
 * Time: 15:20
 */
namespace Cxp\Curl\Facades;
use Illuminate\Support\Facades\Facade;
class Curl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'curl';
    }
}