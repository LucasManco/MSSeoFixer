<?php
namespace LucasManco\MSSeoFixer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Cms\Model\Page;
use Magento\Store\Model\StoreManagerInterface;

class Seo extends Template
{
    
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    
    }
    public function getCurrentUrl(){
        $currentUrl = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);

        return $currentUrl;
    }

    public function getStoreId(){
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();        
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        
        $storeId =  $storeManager->getStore()->getCode();
        return $storeId;
    }
}

