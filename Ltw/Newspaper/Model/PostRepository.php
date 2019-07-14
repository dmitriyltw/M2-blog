<?php

namespace Ltw\Newspaper\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Ltw\Newspaper\Api\Data\PostInterfaceFactory;
use Ltw\Newspaper\Api\Data\PostSearchResultsInterfaceFactory;
use Ltw\Newspaper\Api\PostRepositoryInterface;
use Ltw\Newspaper\Model\ResourceModel\Post as ResourcePost;
use Ltw\Newspaper\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

/**
 * Class PostRepository
 * @package Ltw\Newspaper\Model
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var ResourcePost
     */
    protected $resource;

    /**
     * @var ExtensibleDataObjectConverter
     */
    protected $extensibleDataObjectConverter;

    /**
     * @var PostCollectionFactory
     */
    protected $postCollectionFactory;

    /**
     * @var PostInterfaceFactory
     */
    protected $dataPostFactory;

    /**
     * @var PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ResourcePost $resource
     * @param PostFactory $postFactory
     * @param PostInterfaceFactory $dataPostFactory
     * @param PostCollectionFactory $postCollectionFactory
     * @param PostSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePost $resource,
        PostFactory $postFactory,
        PostInterfaceFactory $dataPostFactory,
        PostCollectionFactory $postCollectionFactory,
        PostSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->postCollectionFactory = $postCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPostFactory = $dataPostFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ltw\Newspaper\Api\Data\PostInterface $post
    ) {
        /* if (empty($post->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $post->setStoreId($storeId);
        } */

        $postData = $this->extensibleDataObjectConverter->toNestedArray(
            $post,
            [],
            \Ltw\Newspaper\Api\Data\PostInterface::class
        );

        $postModel = $this->postFactory->create()->setData($postData);

        try {
            $this->resource->save($postModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the post: %1',
                $exception->getMessage()
            ));
        }
        return $postModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($postId)
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $postId);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $postId));
        }
        return $post->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->postCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ltw\Newspaper\Api\Data\PostInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ltw\Newspaper\Api\Data\PostInterface $post
    ) {
        try {
            $postModel = $this->postFactory->create();
            $this->resource->load($postModel, $post->getPostId());
            $this->resource->delete($postModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($postId)
    {
        return $this->delete($this->getById($postId));
    }
}
