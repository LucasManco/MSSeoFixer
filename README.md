# MSSeoFixer

Este Modulo magento foi criado com o objetivo de corrigir um problema de rankeamento de SEO causado por paginas CMS compartilhadas entre diferentes store-views no magento.

## Instalação

Para a instalação, é necessário que o código deste repósitorio esteja corretamente inserido dentro do caminho.

app/code/LucasManco/MSSeoFixer


## Modo de Funcionamento
  O modulo adiciona um novo bloco ao head da página

  ```
<body>
        <referenceBlock name="head.additional">
            <block class="Magento\Framework\View\Element\Template" name="lucasmanco_seofixer" template="LucasManco_MSSeoFixer::seo.phtml" cacheable="false"/>

        </referenceBlock>
    </body>
```
A tag cacheable="false" foi adicionanda para garantir que este bloco não seja cacheado assim atualizando corretamente ao trocar de store-view.

O arquivo Block/seo.php tem o papel de coletar os dados que serão utilizados pelo phtml para montar o link conforme mostra abaixo.

```
<?php
    
    $StoreIdList = $this->getStoreIds();
    if($StoreIdList){
        $urlList = $this->getUrls($StoreIdList);
        $cmsPageUrl = $block->getCmsPageUrl();

        foreach($StoreIdList as $key=>$StoreId){
            echo '<link rel="alternate" hreflang="'.$StoreId.'" href="'.$urlList[$key]. $cmsPageUrl.'">';
        }
    }    
    
?>
```

