<?php
/**
 * Decorator that inserts debugging hints into the rendered block contents
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Hackathon\VisualEditor\Model\TemplateEngine\Decorator;

use Magento\Cms\Block\Block;
use Magento\Backend\Model\UrlInterface;

class VisualEditor implements \Magento\Framework\View\TemplateEngineInterface
{
    /**
     * @var \Magento\Framework\View\TemplateEngineInterface
     */
    private $_subject;

    private $urlBuilder;

    /**
     * @param \Magento\Framework\View\TemplateEngineInterface $subject
     * @param bool $showBlockHints Whether to include block into the debugging information or not
     */
    public function __construct(\Magento\Framework\View\TemplateEngineInterface $subject, \Magento\Backend\Model\UrlInterface $urlBuilder)
    {
        $this->_subject = $subject;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Insert debugging hints into the rendered block contents
     *
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\View\Element\BlockInterface $block, $templateFile, array $dictionary = [])
    {
        $result = $this->_subject->render($block, $templateFile, $dictionary);
        
        if($block instanceof Block) {
            $result = $this->_renderBlockHints($result, $block);
        }

        return $result;
    }


    /**
     * Insert block debugging hints into the rendered block contents
     *
     * @param string $blockHtml
     * @param \Magento\Framework\View\Element\BlockInterface $block
     * @return string
     */
    protected function _renderBlockHints($blockHtml, \Magento\Framework\View\Element\BlockInterface $block)
    {

        

        return <<<HTML
<a href="{$url}" style="border: 1px solid #ff5501; display: block;">
{$blockHtml}
</a>
HTML;

    }
}
