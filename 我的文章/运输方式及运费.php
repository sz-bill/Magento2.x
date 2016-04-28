<?php
namespace SM\Express\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;

class Express extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'express';
	
	protected $_logger;
    /**
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;


    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
		$this->_logger = $logger;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * @param RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result|bool
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        #print_r(get_class_methods($request));
        $info = array(
            'city'=>$request->getDestCity()
           ,'company'=>$request->getDestCompany() ## 不知道为什么获取出来为空的
           ,'country_id'=>$request->getDestCountryId()
           ,'firstname'=>$request->getDestFirstname() ##不知道为什么获取出来为空的
           ,'lastname'=>$request->getDestLastname() ##不知道为什么获取出来为空的
           ,'postcode'=>$request->getDestPostcode()
           ,'region'=>$request->getDestRegion() ##不知道为什么获取出来为空的
           ,'region_code'=>$request->getDestRegionCode()
           ,'region_id'=>$request->getDestRegionId()
           ,'street'=>$request->getDestStreet()
           ,'telphone'=>$request->getDestTelphone() ##不知道为什么获取出来为空的
           
        );
        #$this->_logger->addDebug('$info');
        $this->_logger->log(100, print_r($info, true));
        
        $quoteArr = null;
        foreach ($request->getAllItems() as $item) {
            $quoteArr['item_id'] = $item->getitem_id();
            $quoteArr['quote_id'] = $item->getquote_id();
            $quoteArr['product_id'] = $item->getproduct_id();
            $quoteArr['parent_item_id'] = $item->getparent_item_id();
            $quoteArr['is_virtual'] = $item->getis_virtual();
            $quoteArr['sku'] = $item->getsku();
            $quoteArr['name'] = $item->getname();
            $quoteArr['qty'] = $item->getqty();
            $quoteArr['weight'] = $item->getweight();
            $quoteArr['price'] = $item->getprice();
            $quoteArr['base_price'] = $item->getbase_price();
            $quoteArr['custom_price'] = $item->getcustom_price();
            $quoteArr['discount_percent'] = $item->getdiscount_percent();
            $quoteArr['discount_amount'] = $item->getdiscount_amount();
        }
        #$this->_logger->addDebug('测试');
        $this->_logger->log(100, print_r($quoteArr, true));

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();
		
		$shippingPrice = $this->getConfigData('price');
		$method = $this->_rateMethodFactory->create();
		$method->setCarrier($this->_code);
		$method->setCarrierTitle($this->getConfigData('title'));
		$method->setMethod($this->_code);
		$method->setMethodTitle($this->getConfigData('name'));
		$method->setPrice($shippingPrice);
		$method->setCost($shippingPrice);
		$result->append($method);
        

        return $result;
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
		
        return [$this->_code=> $this->getConfigData('name')];
    }
}
