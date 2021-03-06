<?php

namespace Social\ManagerBundle\Entity;

/**
 * FeedsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FeedsRepository extends \Doctrine\ORM\EntityRepository {

    public function _getCountListByUser($user_id) {
        $q = 'SELECT c FROM SocialManagerBundle:Feeds c';
        $q .= ' WHERE c.u_id =' . $user_id;
        $total = $this->getEntityManager()->createQuery($q)->getResult();
        return count($total);
    }

    public function _getProListByUser($user_id, $page = 1, $limit = 12) {
        $q = 'SELECT c FROM SocialManagerBundle:Feeds c ';
        $q .= ' WHERE c.u_id =' . $user_id;
        $q .= ' ORDER BY c.id DESC';
        return $this->getEntityManager()
                        ->createQuery($q)
                        ->setMaxResults($limit)
                        ->setFirstResult(($page - 1) * $limit)
                        ->getResult();
    }
    
    public function getTop($page = 1, $limit = 100) {
        $q = 'SELECT c FROM SocialManagerBundle:Feeds c ';
        $q .= ' WHERE c.status = 0 AND c.time_post <= ' .time();
        $q .= ' ORDER BY c.time_post ASC';
        return $this->getEntityManager()
                        ->createQuery($q)
                        ->setMaxResults($limit)
                        ->setFirstResult(($page - 1) * $limit)
                        ->getResult();
    }

    public function _getCountListByAdmin() {
        $q = 'SELECT c FROM SocialManagerBundle:Feeds c';
        $total = $this->getEntityManager()->createQuery($q)->getResult();
        return count($total);
    }

    public function _getProListByAdmin($page = 1, $limit = 12) {
        $q = 'SELECT c FROM SocialManagerBundle:Feeds c ';
        $q .= ' ORDER BY c.id DESC';
        return $this->getEntityManager()
                        ->createQuery($q)
                        ->setMaxResults($limit)
                        ->setFirstResult(($page - 1) * $limit)
                        ->getResult();
    }
}
