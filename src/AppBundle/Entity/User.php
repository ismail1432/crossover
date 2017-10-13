<?php
/**
 * Created by PhpStorm.
 * User: contact@smaine.me
 * Date: 13/10/2017
 * Time: 23:07
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="reporter", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(nullable=true)
     */
    private $articles;

    public function __construct()
    {
        parent::__construct();

    }

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }

    public function getRole()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }



}