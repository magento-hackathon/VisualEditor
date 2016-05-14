<?php

namespace Hackathon\VisualEditor\Block;

class HintedBlock extends \Magento\Cms\Block\Block
{

    protected function _toHtml() {
        $blockId = $this->getBlockId();
        $html = '';
        if ($blockId) {
            $storeId = $this->_storeManager->getStore()->getId();
            /** @var \Magento\Cms\Model\Block $block */
            $block = $this->_blockFactory->create();
            $block->setStoreId($storeId)->load($blockId);
            if ($block->isActive()) {
                $content = $this->_filterProvider->getBlockFilter()->setStoreId($storeId)->filter($block->getContent());

                $html = '<div class="visualeditor_block_container">
                            <span class="visualeditor_block_identifier">' . $this->getBlockId() . ' / ' . $block->getTitle() . '</span>
                            ' . $content . '
                        </div>';
            }
        }

        return $html;
    }

}