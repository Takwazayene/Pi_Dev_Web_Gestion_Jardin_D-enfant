<?php

namespace DorsafBundle\Repository;

/**
 * ClubRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClubRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchClubs($search)
    {
    $q=$this->getEntityManager()->createQuery("SELECT m from DorsafBundle:Club m where (m.nomClub like :motcle)")
        ->setParameter('motcle','%'.$search.'%');
    return $query=$q->getResult();

   }

}
