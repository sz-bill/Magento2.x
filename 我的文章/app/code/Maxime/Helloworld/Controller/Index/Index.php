<?php
namespace Maxime\Helloworld\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute() {
       echo 'Execute Action Index_Index OK  <br>  Maxime\Helloworld\Controller\Index ';
       echo '<br>缺省值的时候默认执行的函数: execute()';
       die();
    }
    public function testAction(){
       echo '<br>执行的指定函数: test()';
       die() ;
    }
}