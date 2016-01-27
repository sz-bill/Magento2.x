<?php
namespace Maxime\Helloworld\Controller\Say;
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute() {
       echo 'Execute Action Say_Index OK  <br>  Maxime\Helloworld\Controller\Say ';
       echo '<br>缺省值的时候默认执行的函数: execute()';
       die();
    }
    public function testAction(){
       echo '<br>执行的指定函数: test()';
       die() ;
    }
}