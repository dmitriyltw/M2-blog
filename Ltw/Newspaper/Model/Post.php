<?php

namespace Ltw\Newspaper\Model;

use Magento\Framework\Api\DataObjectHelper;
use Ltw\Newspaper\Api\Data\PostInterface;
use Ltw\Newspaper\Api\Data\PostInterfaceFactory;

/**
 * Class Post
 * @package Ltw\Newspaper\Model
 */
class Post extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var PostInterfaceFactory
     */
    protected $postDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    protected $_eventPrefix = 'ltw_newspaper_post';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PostInterfaceFactory $postDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ltw\Newspaper\Model\ResourceModel\Post $resource
     * @param \Ltw\Newspaper\Model\ResourceModel\Post\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PostInterfaceFactory $postDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ltw\Newspaper\Model\ResourceModel\Post $resource,
        \Ltw\Newspaper\Model\ResourceModel\Post\Collection $resourceCollection,
        array $data = []
    ) {
        $this->postDataFactory = $postDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve post model with post data
     * @return PostInterface
     */
    public function getDataModel()
    {
        $postData = $this->getData();
        
        $postDataObject = $this->postDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $postDataObject,
            $postData,
            PostInterface::class
        );
        
        return $postDataObject;
    }
}
