<?php

namespace Ltw\Newspaper\Api\Data;

/**
 * Interface PostSearchResultsInterface
 * @package Ltw\Newspaper\Api\Data
 */
interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Post list.
     * @return \Ltw\Newspaper\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set headline list.
     * @param \Ltw\Newspaper\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
