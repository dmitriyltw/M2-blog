<?php

namespace Ltw\Newspaper\Api\Data;

/**
 * Interface PostInterface
 * @package Ltw\Newspaper\Api\Data
 */
interface PostInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const POST_CONTENT = 'post_content';
    const UPDATED_AT = 'updated_at';
    const POST_ID = 'post_id';
    const SHORT_DESCRIPTION = 'short_description';
    const HEADLINE = 'headline';
    const CREATED_AT = 'created_at';
    const FEATURED_IMAGE = 'featured_image';

    /**
     * Get post_id
     * @return string|null
     */
    public function getPostId();

    /**
     * Set post_id
     * @param string $postId
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setPostId($postId);

    /**
     * Get headline
     * @return string|null
     */
    public function getHeadline();

    /**
     * Set headline
     * @param string $headline
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setHeadline($headline);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ltw\Newspaper\Api\Data\PostExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ltw\Newspaper\Api\Data\PostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ltw\Newspaper\Api\Data\PostExtensionInterface $extensionAttributes
    );

    /**
     * Get post_content
     * @return string|null
     */
    public function getPostContent();

    /**
     * Set post_content
     * @param string $postContent
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setPostContent($postContent);

    /**
     * Get short_description
     * @return string|null
     */
    public function getShortDescription();

    /**
     * Set short_description
     * @param string $shortDescription
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setShortDescription($shortDescription);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setUpdatedAt($updatedAt);

    public function setFeaturedImage($featuredImage);

    /**
     * Get featured_image
     * @return string|null
     */
    public function getFeaturedImage();
}
