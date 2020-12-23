<?php
namespace App;

/**
 * 控制器基类
 */
class Controller
{
    public $request;
    public $response;

    function __construct($req, $res) {
        $this->request = $req;
        $this->response = $res;
    }

    public function request()
    {
        return $this->request;
    }

    public function response()
    {
        return $this->response;
    }
}