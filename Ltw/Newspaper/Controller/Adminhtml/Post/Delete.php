<?php

namespace Ltw\Newspaper\Controller\Adminhtml\Post;

/**
 * Class Delete
 * @package Ltw\Newspaper\Controller\Adminhtml\Post
 */
class Delete extends \Ltw\Newspaper\Controller\Adminhtml\Post
{
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('post_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\Ltw\Newspaper\Model\Post::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Post.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['post_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Post to delete.'));
        
        return $resultRedirect->setPath('*/*/');
    }
}
