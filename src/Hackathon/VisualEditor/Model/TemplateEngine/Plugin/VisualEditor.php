<?php

namespace Hackathon\VisualEditor\Model\TemplateEngine\Plugin;

use Magento\Framework\View\TemplateEngineInterface;
use Hackathon\VisualEditor\Model\TemplateEngine\Decorator\VisualEditorFactory;
use Magento\Cms\Block\Widget\Block;
use Magento\Backend\Model\UrlInterface;

class VisualEditor {

    private $decoratorFactory;
    private $blockFactory;
    private $storeManager;
    private $urlBuilder;

    public function __construct(VisualEditorFactory $decorator,
                                \Magento\Cms\Model\BlockFactory $blockFactory, \Magento\Store\Model\StoreManagerInterface $storeManager,  \Magento\Backend\Model\UrlInterface $urlBuilder)
    {
        $this->decoratorFactory = $decorator;
        $this->blockFactory = $blockFactory;
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;

    }

    /**
     * Wrap template engine instance with Visual Editor html
     *
     * @param TemplateEngineFactory $subject
     * @param TemplateEngineInterface $invocationResult
     *
     * @return TemplateEngineInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterToHtml(
        \Magento\Cms\Block\Widget\Block $block,
        $html
    ) {
        
        if($block->getBlockId()){
            $blockInstance = $this->blockFactory->create();

            $blockInstance->setStoreId($this->storeManager->getStore()->getId())->load($block->getBlockId());

            $url = $this->urlBuilder->getUrl("cms/block/edit",['block_id' => $blockInstance->getBlockId()]);

            $frontendIdentifier = md5($block->getBlockId() . $html);


            return '<div class="visualeditor_block_container">
                            <span class="visualeditor_block_identifier">' . $block->getBlockId() . ' / ' . $blockInstance->getTitle() . ' | <a href="'.$url.'">Edit</a></span>
                            <span class="visualeditor_content" data-content-identifier="' . $frontendIdentifier .'">' . $html . '</span>
                            <textarea class="visualeditor_textarea" data-textarea-identifier="' . $frontendIdentifier .'">' . $blockInstance->getContent() .'</textarea>
                        </div>';
        }


    }

}