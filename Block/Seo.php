<?php
namespace LucasManco\MSSeoFixer\Block;

use Magento\Framework\View\Element\Template;

class Seo extends Template
{
    private $storeManager;
    private $pageModel;
    private $context;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\Page $pageModel,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->pageModel = $pageModel;
        $this->context = $context;
        parent::__construct($context, $data);
        
    }
    public function getUrls($storeViews){
        
        $baseUrls = [];
        foreach ($storeViews as $storeview) {
            $store = $this->storeManager->getStore($storeview);
            $baseUrls[] = $store->getBaseUrl();
        }
        return $baseUrls;
    }

    public function getStoreIds(){
        
        $pageId = $this->getRequest()->getParam('page_id');

        // die(json_encode($pageId));
        $page = $this->pageModel->load($pageId);
        
        $storeIds = $page->getStoreId();
        // die(json_encode($storeIds));
        if (!$storeIds) {
            return false;
        }
        //storeid = 0 => all store views
        if ($storeIds[0] == 0){
            $storeManagerDataList = $this->_storeManager->getStores();
            // die(json_encode($storeManagerDataList));
            foreach ($storeManagerDataList as $storeId=>$store) {
                $storeViews[] = $store->getCode();
            }
        }
        else{
            foreach ($storeIds as $storeId) {
                $store = $this->storeManager->getStore($storeId);
                $storeViews[] = $store->getCode();
            }
        }
        

        
        return $storeViews;
    }
    public function getCmsPageUrl(){
        $pageId = $this->getRequest()->getParam('page_id');
        $page = $this->pageModel->load($pageId);
        $cmsPageUrl = $page->getIdentifier();
    
        return $cmsPageUrl;
    }

}

