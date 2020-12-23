<?php

namespace App;

class Response
{
    public $textplan = '';
    public $request;

    function __construct(Request $req) {
        $this->request = $req;
    }

    public function write($str)
    {
        $this->textplan .= $str;
    }

    public function output()
    {
        return $this->textplan;
    }

    public function run()
    {
        $path = explode('/', $this->request->event->path);
        unset($path[1]);
        $path = implode('/', array_filter($path));
        list($class, $action) = $this->decodePath($path);

        if(!$class){
            $this->write("class $action does not exist.");
            return;
        }

        //调用控制器
        (new $class($this->request, $this))->$action();

        //解析请求
        // try{
            // 此处无需处理异常，由系统接管
        // }catch(\Throwable $e){
        //     $msg = $e->getMessage();
        //     error_log($msg);
        //     throw new \Exception($msg);
        // }
    }

    //urlpath解析到类名和方法
    public function decodePath($path)
    {
        // 控制器实现
        $uri = explode('/', $path);
        $len = count($uri);
        $len_c = $len > 1 ? $len -1 : $len;

        //遍历命名空间
        $ns_str = '';
        for($i = 0; $i < $len_c; $i++){
            if($uri[$i])
                $ns_str .= '\\'.ucfirst($uri[$i]);
        }

        //拼接类名和命名空间，默认Index
        $class = '\\App\\Controller'. ($ns_str ?: '\\Index');

        if(!class_exists($class)){
            //该类不存在
            // echo "class $class does not exist. \n";
            return [null, $class];
        }

        //方法名获取，默认index
        $action = $len > 1 ? $uri[$len -1] : 'index';

        return [$class,$action];
        //new该类并调用方法

        // (new $class())->$action();
        // var_dump([$class,$action]);
    }
}
