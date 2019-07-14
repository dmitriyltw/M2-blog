<?php

namespace Ltw\Newspaper\Model\ResourceModel\Post;

/**
 * Class Collection
 * @package Ltw\Newspaper\Model\ResourceModel\Post
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ltw\Newspaper\Model\Post::class,
            \Ltw\Newspaper\Model\ResourceModel\Post::class
        );
    }
}
