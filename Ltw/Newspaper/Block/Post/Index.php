<?php

namespace Ltw\Newspaper\Block\Post;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Widget\Block\BlockInterface;
use Ltw\Newspaper\Model\ResourceModel\Post\CollectionFactory;
use Ltw\Newspaper\Model\ImageUploader;

/**
 * Class Index
 * @package Ltw\Newspaper\Block\Post
 */
class Index extends Template implements BlockInterface
{
    /**
     * @var CollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Registry
     */
    private $_registry;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * Index constructor.
     * @param Registry $registry
     * @param CollectionFactory $postCollectionFactory
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Registry $registry,
        CollectionFactory $postCollectionFactory,
        Context $context,
        StoreManagerInterface $storeManager,
        ImageUploader $imageUploader,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->context               = $context;
        $this->_registry             = $registry;
        $this->_storeManager         = $storeManager;
        $this->imageUploader         = $imageUploader;
        parent::__construct($context, $data);
    }
    /**
     * @return \Ltw\Newspaper\Model\Data\Post[]
     */
    public function getCollection()
    {
        return $this->postCollectionFactory->create()->addFieldToFilter('post_id', ['eq' => $this->getParam()]);
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return  $this->_registry->registry('newspaper_post_id');
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * @return ImageUploader
     */
    public function getImageUploader()
    {
        return $this->imageUploader;
    }
}
