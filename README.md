# MSSeoFixer

Este Modulo magento foi criado com o objetivo de corrigir um problema de rankeamento de SEO causado por paginas CMS compartilhadas entre diferentes store-views no magento.

##Instalação

Para a instalação, é necessário que o código deste repósitorio esteja corretamente inserido dentro do caminho.

app/code/LucasManco/MSSeoFixer


##Modo de Funcionamento
  O modulo adiciona um novo bloco ao head da página

  ```
<body>
        <referenceBlock name="head.additional">
            <block class="Magento\Framework\View\Element\Template" name="lucasmanco_seofixer" template="LucasManco_MSSeoFixer::seo.phtml" cacheable="false"/>

        </referenceBlock>
    </body>
```
A tag cacheable="false" foi adicionanda para garantir que este bloco não seja cacheado assim atualizando corretamente ao trocar de store-view.

O bloco adicionado é o do arquivo seo.phtml que está abaixo. a váriavel currentUrl traz a url atual da página e o storeId traz o codigo da view que para esta implementação foi definido que será referente ao codigo do idioma da view.

```
<?php
$currentUrl = $this->getUrl('*/*/*', ['_current' => true, '_use_rewrite' => true]);

$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();        
$storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
 
$storeId =  $storeManager->getStore()->getCode();

?>
<link rel="alternate" hreflang="<?php echo $storeId; ?>" href="<?php echo $currentUrl; ?>">
```
