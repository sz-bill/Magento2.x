<?php
## Magento2.x   在Block文件中如何获取URL及URL的参数

## 获取当前URL
$currentUrl = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);


## 获取Get参数
$params = $this->_request->getParams();


## 获取POST参数
$params = $this->_request->getPost();