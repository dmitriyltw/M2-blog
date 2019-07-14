<?php

namespace Ltw\Newspaper\Controller\Post;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    private $_registry;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
        ) {
        $this->_registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postId = $this->getRequest()->getParam('post_id');
        $this->_registry->register('newspaper_post_id',$postId);
        return $this->resultPageFactory->create();
    }
}