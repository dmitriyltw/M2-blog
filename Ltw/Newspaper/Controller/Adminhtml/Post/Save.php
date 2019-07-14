<?php

namespace Ltw\Newspaper\Controller\Adminhtml\Post;

use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Event\Manager;

/**
 * Class Save
 * @package Ltw\Newspaper\Controller\Adminhtml\Post
 */
class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var Manager
     */
    protected $eventManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        Manager $eventManager
    ) {
        $this->eventManager = $eventManager;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->eventManager->dispatch('ltw_newspaper_save_post_before');

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('post_id');

            $model = $this->_objectManager->create(\Ltw\Newspaper\Model\Post::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Post no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            $data = $this->SaveImageToDb($data);
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Post.'));
                $this->dataPersistor->clear('ltw_newspaper_post');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Post.'));
            }

            $this->dataPersistor->set('ltw_newspaper_post', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
        $this->eventManager->dispatch('ltw_newspaper_save_post_after');
    }

    /**
     * @param array $rawData
     * @return array
     */
    public function SaveImageToDb(array $rawData)
    {
        $data = $rawData;
        if (isset($data['featured_image'][0]['name'])) {
            $data['featured_image'] = $data['featured_image'][0]['name'];
        } else {
            $data['featured_image'] = null;
        }
        return $data;
    }
}
