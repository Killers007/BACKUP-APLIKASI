<?php
// use Exception as BaseException;
// use Whoops\Handler\PrettyPageHandler;
// use Whoops\Run;
// require_once FCPATH.'vendor/autoload.php';


class WhoopsHook {
    public function bootWhoops() {
        $whoops = new \Whoops\Run;
        // $whoops->pushHandler(new Whoops\Handler\PlainTextHandler());
        // $whoops->pushHandler(new Whoops\Handler\JsonResponseHandler());
        // $whoops->pushHandler(new Whoops\Handler\XmlResponseHandler());
        // $whoops->pushHandler(new Whoops\Handler\CallbackHandler());
        $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
        $whoops->register();
    }
}