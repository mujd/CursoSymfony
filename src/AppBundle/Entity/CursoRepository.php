<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CursoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CursoRepository extends EntityRepository
{
    public function getCursos(){
        $this->getEntityManager();
        $query = $this->createQueryBuilder("c")
                ->where("c.precio > :precio")
                ->setParameter("precio","79")
                ->getQuery();
        $cursos = $query->getResult();
        return $cursos;
    }
    
    
}
