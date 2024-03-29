<?php

namespace Ltw\Newspaper\Block\Adminhtml\Index;

/**
 * Class Index
 * @package Ltw\Newspaper\Block\Adminhtml\Index
 */
class Index extends \Magento\Backend\Block\Template
{
    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}
