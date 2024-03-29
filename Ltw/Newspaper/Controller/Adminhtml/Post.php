<?php

namespace Ltw\Newspaper\Controller\Adminhtml;

/**
 * Class Post
 * @package Ltw\Newspaper\Controller\Adminhtml
 */
abstract class Post extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    const ADMIN_RESOURCE = 'Ltw_Newspaper::top_level';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Ltw'), __('Ltw'))
            ->addBreadcrumb(__('Post'), __('Post'));
        return $resultPage;
    }
}
