<?php
namespace Maxime\Jobs\Model\ResourceModel\Job;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Job extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Maxime\Jobs\Model\Job', 'Maxime\Jobs\Model\ResourceModel\Job');
    }
 
}