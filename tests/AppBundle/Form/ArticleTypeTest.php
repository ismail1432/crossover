<?php

/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 14/10/2017
 * Time: 08:55
 */

namespace Tests\AppBundle\Form\Type;

use AppBundle\Entity\Image;
use AppBundle\Form\ArticleType;
use AppBundle\Entity\Article;
use Symfony\Component\Form\Test\TypeTestCase;

class ArticleTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'title' => 'THIS IS A THE TITLE',
            'text' => 'THIS IS TEXT',
            'image' => null,
            'currentDate' => null
        );

        $form = $this->factory->create(ArticleType::class);

        //Mock Object
        $object = new Article();
        $object->setTitle($formData['title']);
        $object->setText($formData['text']);
        $object->setImage(new Image());
        $object->setCurentDate(null);

        //Submit Form
        $form->submit($formData);

        //Submit Object
        $submitObject = new Article();
        $submitObject->setTitle($form->getData()->getTitle());
        $submitObject->setText($form->getData()->getText());
        $submitObject->setImage(new Image());
        $submitObject->setCurentDate(null);


        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $submitObject);

        $view = $form->createView();
        $children = $view->children;

        //remove currentDate to avoid assertArrayHasKey errors
        //Datetime is a multidimensionnal array
        unset($formData['currentDate']);
        foreach (array_keys($formData) as $key) {

                $this->assertArrayHasKey($key, $children);

        }
    }
}