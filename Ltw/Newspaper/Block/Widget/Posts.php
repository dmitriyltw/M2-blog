<?php

namespace Ltw\Newspaper\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;
use Ltw\Newspaper\Model\ResourceModel\Post\CollectionFactory;
use Ltw\Newspaper\Model\ImageUploader;

/**
 * Class Posts
 * @package Ltw\Newspaper\Block\Widget
 */
class Posts extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "widget/posts.phtml";

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
    protected $registry;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * Posts constructor.
     * @param CollectionFactory $postCollectionFactory
     * @param Context $context
     * @param Registry $registry
     * @param StoreManagerInterface $storeManager
     * @param ImageUploader $imageUploader
     * @param array $data
     */
    public function __construct(
        CollectionFactory $postCollectionFactory,
        Context $context,
        Registry $registry,
        StoreManagerInterface $storeManager,
        ImageUploader $imageUploader,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->context               = $context;
        $this->registry              = $registry;
        $this->_storeManager         = $storeManager;
        $this->imageUploader         = $imageUploader;
        parent::__construct($context, $data);
    }
    /**
     * @return \Ltw\Newspaper\Model\Data\Post[]
     */
    public function getCollection()
    {
        return $this->postCollectionFactory->create()
            ->setOrder('post_id', 'desc')
            ->setPageSize($this->getRecentPosts());
    }

    /**
     * @return int
     */
    public function getRecentPosts()
    {
        return  $this->getData('display_type');
    }

    /**
     * @param $postId
     * @return string
     */
    public function getCustomUrl($postId)
    {
        return $this->getUrl('ltw_blog/post/index', ['post_id' => $postId]);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    /**
     * @return int
     */
    public function getImageWidth()
    {
        if ($this->getData('image_width')) {
            return (int)$this->getData('image_width');
        }

        return 0;
    }

    /**
     * @return int
     */
    public function getImageHeight()
    {
        if ($this->getData('image_height')) {
            return (int)$this->getData('image_height');
        }

        return 0;
    }

    /**
     * @return ImageUploader
     */
    public function getImageUploader()
    {
        return $this->imageUploader;
    }
}
