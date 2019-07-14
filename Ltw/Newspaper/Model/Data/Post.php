<?php

namespace Ltw\Newspaper\Model\Data;

use Ltw\Newspaper\Api\Data\PostInterface;

/**
 * Class Post
 * @package Ltw\Newspaper\Model\Data
 */
class Post extends \Magento\Framework\Api\AbstractExtensibleObject implements PostInterface
{

    /**
     * Get post_id
     * @return string|null
     */
    public function getPostId()
    {
        return $this->_get(self::POST_ID);
    }

    /**
     * Set post_id
     * @param string $postId
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setPostId($postId)
    {
        return $this->setData(self::POST_ID, $postId);
    }

    /**
     * Get headline
     * @return string|null
     */
    public function getHeadline()
    {
        return $this->_get(self::HEADLINE);
    }

    /**
     * Set headline
     * @param string $headline
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */

    public function setHeadline($headline)
    {
        return $this->setData(self::HEADLINE, $headline);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ltw\Newspaper\Api\Data\PostExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Ltw\Newspaper\Api\Data\PostExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ltw\Newspaper\Api\Data\PostExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get post_content
     * @return string|null
     */
    public function getPostContent()
    {
        return $this->_get(self::POST_CONTENT);
    }

    /**
     * Set post_content
     * @param string $postContent
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setPostContent($postContent)
    {
        return $this->setData(self::POST_CONTENT, $postContent);
    }

    /**
     * Get short_description
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->_get(self::SHORT_DESCRIPTION);
    }

    /**
     * Set short_description
     * @param string $shortDescription
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setShortDescription($shortDescription)
    {
        return $this->setData(self::SHORT_DESCRIPTION, $shortDescription);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getFeaturedImage()
    {
        return $this->_get(self::FEATURED_IMAGE);
    }

    /**
     * Set featured_image
     * @param string $featuredImage
     * @return \Ltw\Newspaper\Api\Data\PostInterface
     */
    public function setFeaturedImage($featuredImage)
    {
        return $this->setData(self::FEATURED_IMAGE, $featuredImage);
    }
}
