<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 10:25
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadArticle extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) :void
    {
        $i = 0;
        //There 12 images
        while ($i < 11){
            //Persist the image and return it
            $image =  $this->loadImage($manager,$i);
            //Create artcile
            $this->provideDatas($manager,$image);
            $i++;
        }
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param Image $image
     */
    public function provideDatas(ObjectManager $manager, Image $image) :void
    {

        $content = "Comics may have been a good companion for many people in their childhood. Except for the illustration and storyline in
         the comic books that attracted us, fonts used in the comic books also make characters and stories more attractive, emotional. 
         Comic fonts are funny fonts usually related to a comic book or children. They often appear in the creation of a comic book including
          titles, logos, and the text. Probably the only comic font most people know well is the Comic Sans MS that is available on
           Windows computer. But there are more comics fonts to know in addition to Comic Sans MS.
           Comic fonts look fun, yet they are not limited to that: they are funny but not that fancy, 
           they are eligible yet creative, they invoke unlimited energy, vigorous imagination besides humor. 
           Therefore comic fonts by no means should be confined to comic books. So why limit comic fonts only to Comic 
           Sans MS and comic books? And perhaps have a try and using comic fonts for your greeting cards, headlines, posters, 
           invitations and website logos? Classic Comic designed by Patrick Griffin is a typical font family of comic style. 
           Classic Comic supports all popular formats and letters in most Central, Eastern, and Western European languages as well as Baltic, 
           Maltese";

        $title = ["interview","meeting", "urgency", "curiosity", "cool storie", "clover", "summer", "hollidays", "problem", "question"];

        //Display random title
        $titleRand = rand(0 , 9);

        $reporter = $this->getReference('user');


        $article = new Article();
        $article->setReporter($reporter);
        $article->setText($content);
        $article->setTitle($title[$titleRand]);
        $article->setImage($image);

        $manager->persist($article);

    }

    /**
     * @param $manager
     * @param $key
     * @return Image
     */
    public function loadImage($manager, $key) :Image
    {
        $imagesTab = [
            'barcelona', 'berlin', 'dubai', 'geneve', 'londres', 'lyon',
            'miami', 'monaco', 'newYork', 'paris', 'tokyo', 'tunis',
        ];

            $image = new Image();
            $image->setUrl($imagesTab[$key].'.jpeg');
            $image->setAlt($imagesTab[$key]);

        return $image;
    }

    /**
     * @return array
     */
    public function getDependencies() :array
    {
        return array(
            LoadUser::class,
        );
    }

}
