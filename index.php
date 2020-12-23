<?php

require './vendor/autoload.php';

//入口函数 -腾讯云
function main($event, $context){

    $req = new \App\Request($event, $context);

    $res = new \App\Response($req);

    $res->run();

    return $res->output();
}
