<?php
##通过id加载分类信息
## http://www.mage2solutions.com/magento2-load-category-using-category-id/
##Magento2 load category using category Id
##If you have category Id then you can use this code in any page

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

$category = $objectManager->create('Magento\Catalog\Model\Category')->load($id);

#If you are working on category page then you can get category id from Registry

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$category = $objectManager->get('Magento\Framework\Registry')->registry('current_category');