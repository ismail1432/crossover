<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="curent_date", type="datetime")
     */
    private $curentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="reporter", type="string", length=255)
     */
    private $reporter;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist"})
     */
    private $image;

    public function __construct()
    {
        $this->setCurentDate( new \DateTime('now'));
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set curentDate
     *
     * @param \DateTime $curentDate
     *
     * @return Article
     */
    public function setCurentDate($curentDate)
    {
        $this->curentDate = $curentDate;

        return $this;
    }

    /**
     * Get curentDate
     *
     * @return \DateTime
     */
    public function getCurentDate()
    {
        return $this->curentDate;
    }

    /**
     * Set reporter
     *
     * @param string $reporter
     *
     * @return Article
     */
    public function setReporter($reporter)
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * Get reporter
     *
     * @return string
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getResume()
    {
        return substr($this->text,0, 50);
    }

}

