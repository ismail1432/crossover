<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 10:38
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Image;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadImage implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
       $imagesTab = [
           'barcelona',
           'berlin',
           'dubai',
           'geneve',
           'londres',
           'lyon',
           'miami',
           'monaco',
           'newYork',
           'paris',
           'tokyo',
           'tunis',
       ];

       $image = new Image();

       $image->setUrl($imagesTab[0].'.jpeg');
       $image->setAlt($imagesTab[0]);

        $manager->persist($image);
        $manager->flush();

    }
}