<?php

namespace Payutc\OnyxBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

use Payutc\OnyxBundle\Entity\Deletable\DeletableEntityRepositoryInterface;
use Payutc\OnyxBundle\Entity\Activable\ActivableEntityRepositoryInterface;

/**
 * UserGroupRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserGroupRepository extends EntityRepository implements DeletableEntityRepositoryInterface, ActivableEntityRepositoryInterface
{
	/**
     * Find all entities that have removed_at set up to null.
     *
     * @return array
     */
	public function findAll()
	{
		return $this->findAllNotDeleted();
	}

	/**
     * Find all entities that have removed_at set up to null.
     *
     * @return array
     */
	public function findAllNotDeleted()
	{
		$qb = $this->_em->createQueryBuilder();

		$qb->select('ug')
			->from('PayutcOnyxBundle:UserGroup', 'ug')
			->where($qb->expr()->isNull('ug.removedAt'))
		;

		return $qb->getQuery()->getResult();
	}

	/**
     * Find all entities that have removed_at set up to null and is_hidden property set up to false.
     *
     * @return array
     */
	public function findAllActive()
	{
		$qb = $this->_em->createQueryBuilder();

		$qb->select('ug')
			->from('PayutcOnyxBundle:UserGroup', 'ug')
			->where($qb->expr()->isNull('ug.removedAt'))
			->andWhere('ug.isHidden = :isHidden')
			->setParameter('isHidden', false)
		;

		return $qb->getQuery()->getResult();
	}
}