<?php
第一步::
在一类的构造函数中这样写

public function __construct(
        #\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        #\Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        #\Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        #\Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        #$this->_rateResultFactory = $rateResultFactory;
        #$this->_rateMethodFactory = $rateMethodFactory;
		$this->_logger = $logger;
        #parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
		parent::__construct($data);
    }


第二步::
	然后可以这个类的其它函数中这与写
	$this->_logger->addDebug('some text or variable');


第三步::用例
$this->_logger->addDebug($message); // log location: var/log/system.log
$this->_logger->addInfo($message); // log location: var/log/exception.log
$this->_logger->addNotice($message); // log location: var/log/exception.log
$this->_logger->addError($message); // log location: var/log/exception.log
$this->_logger->critical($e); // log location: var/log/exception.log


数组内容， $a为数组 
#public function  \Psr\Log\LoggerInterface::log($level, $message, array $context = array());
$this->_logger->log(100,print_r($a,true)); #print_r($a,true), 必须加上参数 true 才会写到debug的日志中， 否则会导致页面出错不能正常显示