<?php


namespace TRAW\EventNotifications\Domain\Repository;


use TRAW\EventNotifications\Domain\Factory\NotificationFactory;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class NotificationRepository
 * @package TRAW\EventNotifications\Domain\Repository
 */
class NotificationRepository
{
    /**
     *
     */
    public const tableName = 'tx_eventnotifications_domain_model_notification';

    protected array $selectColumns = [];

    public function __construct()
    {
        $this->selectColumns = NotificationFactory::getSettableProperties();
    }

    /**
     * @param string $notificationType
     * @return array
     */
    public function findByType(string $notificationType): array
    {
        /** @var QueryBuilder $qb */
        $qb = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable(self::tableName);

        $result = $qb->select(...$this->selectColumns)
            ->from(self::tableName)
            ->where(
                $qb->expr()->inSet('events', $qb->createNamedParameter($notificationType, \PDO::PARAM_STR))
            )
            ->execute()
            ->fetchAllAssociative();

        $notifications = [];
        foreach ($result as $item) {
            array_push($notifications, NotificationFactory::buildModelFromData($item));
        }

        return $notifications;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        /** @var QueryBuilder $qb */
        $qb = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable(self::tableName);
        $result = $qb->select(...$this->selectColumns)
            ->from(self::tableName)
            ->execute()
            ->fetchAllAssociative();

        $notifications = [];
        foreach ($result as $item) {
            array_push($notifications, NotificationFactory::buildModelFromData($item));
        }


        return $notifications;
    }
}