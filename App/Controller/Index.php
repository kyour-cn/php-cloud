<?php
namespace App\Controller;

use App\Controller;

/**
 * Index控制器
 */
class Index extends Controller
{
    public function index()
    {
        $request = $this->request();
        $response = $this->response();

        $response->write('hello cloud!');
    }

    public function testApi()
    {
        $request = $this->request();
        $response = $this->response();

        $response->write('hello testApi!');
    }
}
