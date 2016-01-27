<?php
namespace Maxime\Helloworld\Controller\Say;
class Hello extends \Magento\Framework\App\Action\Action
{
    public function execute_bak()
    {
       echo 'Execute Action Say_Hello OK   <br>Maxime\Helloworld\Controller\Say';
       echo '<br>缺省值的时候默认执行的函数: execute()';
       die();
    }
    public function execute(){
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}