<?php

namespace Ltw\Newspaper\Model\ResourceModel;

/**
 * Class Post
 * @package Ltw\Newspaper\Model\ResourceModel
 */
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ltw_newspaper_post', 'post_id');
    }
}
