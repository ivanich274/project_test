<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 04.12.2017
 * Time: 15:07
 */

namespace BlogBundle\DataFixtures;

use BlogBundle\Entity\Blog;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $blog = new Blog();

        $blog->setTitle("This is first Title");

        $blog->setBody("This is first TitleThis is first TitleThis is first TitleThis is first TitleThis is first TitleThis is first TitleThis is first TitleThis is first TitleThis is first Title ");

        $blog->setSummary("This is first TitleThis is first Title");

        $manager->persist($blog);

        $manager->flush();


    }

}