<?php
namespace Maxime\Helloworld\Block;
class Hello extends \Magento\Framework\View\Element\Template
{
    public function MyHello(){
        return $_SERVER;
    }
}