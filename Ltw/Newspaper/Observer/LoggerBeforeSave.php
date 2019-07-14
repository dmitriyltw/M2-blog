<?php

namespace Ltw\Newspaper\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class LoggerBeforeSave
 * @package Ltw\Newspaper\Observer
 */
class LoggerBeforeSave implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * LoggerBeforeSave constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $this->logger->info('began saving the post');
    }
}