<?php
/**
 * Created by PhpStorm.
 * User: Slowbro
 * Date: 17/3/13
 * Time: 下午5:19
 */

function rand_code($code_length = 6)
{
    if($code_length < 1)
    {
        $code_length = 6;
    }
    $min = 1;
    for ($i=0;$i<$code_length;$i++)
    {
        $min = $min*10;
    }

    $max = $min*10 - 1;
    $code = rand($min,$max);
    return $code;
}


?>