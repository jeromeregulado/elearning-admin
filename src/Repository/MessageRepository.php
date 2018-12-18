<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getSenderList($id)
    {
        $sub = $this->createQueryBuilder('mm')
            ->select('MAX(mm.id)')
            ->where('mm.thread = mt.id');

        return $this->createQueryBuilder('m')
            ->select('us.firstName')
            ->addSelect('us.lastName')
            ->addSelect('m.message')
            ->addSelect('mt.id AS thread')
            ->addSelect('m.createdAt')
            ->join('App:MessageThread','mt', Expr\Join::WITH, 'mt = m.thread')
            ->join('App:User','u', Expr\Join::WITH, 'u = mt.teacher')
            ->join('App:Student','us', Expr\Join::WITH, 'us = mt.parent')
            ->where('mt.teacher = :teacher')
            ->andWhere('m.id IN (' . $sub->getDQL(). ')')
            ->groupBy('us.id')
            ->addGroupBy('m.message')
            ->addGroupBy('m.createdAt')
            ->addGroupBy('mt.id')
            ->orderBy('m.createdAt', 'DESC')
            ->setParameter('teacher', $id)
            ->getQuery()
            ->getArrayResult();
    }

    public function getMessages($threadId)
    {
        return $this->createQueryBuilder('m')
            ->select('m.message')
            ->addSelect('m.createdAt')
            ->addSelect('mt.id')
            ->addSelect('IDENTITY(m.senderTeacher) AS sender')
            ->join('App:MessageThread','mt', Expr\Join::WITH, 'mt = m.thread')
            ->join('App:User','u', Expr\Join::WITH, 'u = mt.teacher')
            ->join('App:Student','us', Expr\Join::WITH, 'us = mt.parent')
            ->where('mt = :thread')
            ->orderBy('m.createdAt')
            ->setParameter('thread', $threadId)
            ->getQuery()
            ->getArrayResult();
    }

    public function save($data)
    {
        $em = $this->getEntityManager();
        $em->persist($data);
        return $em->flush();
    }
}
