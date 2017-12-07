<?php

/**
 * Created by PhpStorm.
 * User: Иван
 * Date: 05.12.2017
 * Time: 22:24
 */

namespace BlogBundle\Repository;


use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{
    public function findAllBlogCount()
    {

        $qry = $this->createQueryBuilder("b");
        $qry->select("count(b)");

        return $qry->getQuery()->getOneOrNullResult();
    }

    /**
     * Вывод всех записей постранично.
     * @param $page
     * @return array
     */
    public function findBlog(array $context = [])
    {
        $qry = $this->createQueryBuilder("b");
        $qry->select("b");

        $qry->orderBy("b.id", "ASC");

        $page = 0;

        if (isset($context['page']) && is_numeric($context['page']) && $context['page'] > 1) {
            $page = $context['maxResult'] * (intval($context['page']) - 1);
        }


        $qry->setMaxResults($context['maxResult']);
        $qry->setFirstResult($page);

        return $qry->getQuery()->getResult();

    }


}