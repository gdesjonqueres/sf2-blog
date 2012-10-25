<?php

namespace Guigui\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guigui\BlogBundle\Entity\Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Guigui\BlogBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $author
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool $publication
     *
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

    /**
     * @var Image $image
     *
     * @ORM\OneToOne(targetEntity="Guigui\BlogBundle\Entity\Image")
     * @ORM\JoinColumn(nullable=false)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Guigui\BlogBundle\Entity\Category")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Guigui\BlogBundle\Entity\Comment", mappedBy="article")
     * @var unknown_type
     */
    private $comments;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->publication = true;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
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
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Article
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set image
     *
     * @param Guigui\BlogBundle\Entity\Image $image
     * @return Article
     */
    public function setImage(\Guigui\BlogBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Guigui\BlogBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categories
     *
     * @param Guigui\BlogBundle\Entity\Category $category
     * @return Article
     */
    public function addCategory(\Guigui\BlogBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param Guigui\BlogBundle\Entity\Category $category
     */
    public function removeCategory(\Guigui\BlogBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add categories
     *
     * @param Guigui\BlogBundle\Entity\Category $categories
     * @return Article
     */
    public function addCategorie(\Guigui\BlogBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param Guigui\BlogBundle\Entity\Category $categories
     */
    public function removeCategorie(\Guigui\BlogBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Add comments
     *
     * @param Guigui\BlogBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\Guigui\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
        $comments->setArticle($this);

        return $this;
    }

    /**
     * Remove comments
     *
     * @param Guigui\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\Guigui\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
        $comments->setArticle(null);
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}