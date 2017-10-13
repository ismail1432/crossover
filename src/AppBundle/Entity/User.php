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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="user", cascade={"persist", "remove"} )
     * @ORM\JoinColumn(nullable=true)
     */
    private $articles;

    public function __construct()
    {
        parent::__construct();

    }

    public function getRole()
    {
        return ['ROLES_USER'];
    }

    public func
}