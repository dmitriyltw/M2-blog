<?php

namespace Ltw\Newspaper\Plugin;

/**
 * Class LogMessage
 * @package Ltw\Newspaper\Plugin
 */
class LogMessage
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * LogMessage constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Ltw\Newspaper\Model\ImageUploader $subject
     * @param $result
     */
    public function afterGetBaseTmpPath(
        \Ltw\Newspaper\Model\ImageUploader $subject, $result
    ) {
        $this->logger->info('Image ' . $result);
    }
}
