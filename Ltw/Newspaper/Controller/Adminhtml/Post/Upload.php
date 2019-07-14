<?php

namespace Ltw\Newspaper\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 * @package Ltw\Newspaper\Controller\Adminhtml\Post
 */
class Upload extends \Magento\Backend\App\Action
{
    public $imageUploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ltw\Newspaper\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('featured_image');
//            $result['cookie'] = [
//                'name' => $this->_getSession()->getName(),
//                'value' => $this->_getSession()->getSessionId(),
//                'lifetime' => $this->_getSession()->getCookieLifetime(),
//                'path' => $this->_getSession()->getCookiePath(),
//                'domain' => $this->_getSession()->getCookieDomain(),
//            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);

    }
}
