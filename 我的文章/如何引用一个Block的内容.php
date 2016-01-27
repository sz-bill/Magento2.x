在模块文件中 *.phtml<br>
<?php echo $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId('block_identifier')->toHtml();?><br><br>

在CMS中的Content的页面中<br>
{{block class="Magento\\Cms\\Block\\Block" block_id="block_identifier"}}<br><br>


在xml的配置文件中使用<br>
<referenceContainer name="content">
    <block class="Magento\Cms\Block\Block" name="block_identifier">
        <arguments>
            <argument name="block_id" xsi:type="string">block_identifier</argument>
        </arguments>
    </block>
</referenceContainer>