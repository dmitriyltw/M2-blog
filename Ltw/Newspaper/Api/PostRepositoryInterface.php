<?php

namespace Ltw\Newspaper\Api;

/**
 * Interface PostRepositoryInterface
 * @package Ltw\Newspaper\Api
 */
interface PostRepositoryInterface
{
    /**
     * Save Post
     * @param \Ltw\Newspaper\Api\Data\PostInterface $post
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ltw\Newspaper\Api\Data\PostInterface $post
    );

    /**
     * Retrieve Post
     * @param string $postId
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($postId);

    /**
     * Retrieve Post matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ltw\Newspaper\Api\Data\PostSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Post
     * @param \Ltw\Newspaper\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ltw\Newspaper\Api\Data\PostInterface $post
    );

    /**
     * Delete Post by ID
     * @param string $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postId);
}
