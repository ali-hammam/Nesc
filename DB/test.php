<?php
/*    namespace DB\test;
    function psFileKeyVal($wFile,$d = "="){
        $ary = @file($wFile);
        $res = [];
        if ( is_array($ary) == true )
        {
            foreach ($ary as $line)
            {
                $line = trim($line);
                if ( ($line !="") && (substr($line,0,1) != "#") )
                {
                    //echo $line;
                    list($key,$val) = explode($d,$line,2);
                    $key = trim($key);
                    $val = trim($val);
                    $res[$key] = $val;
                }
            }
        }
        //return implode($res , ' ');
        return $res;
    }

    print_r (psFileKeyVal('../env.txt'));*/
