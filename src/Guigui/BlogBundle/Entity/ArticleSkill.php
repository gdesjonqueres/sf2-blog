<?php

namespace Guigui\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guigui\BlogBundle\Entity\ArticleSkill
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArticleSkill
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Guigui\BlogBundle\Entity\Article")
     */
    private $article;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Guigui\BlogBundle\Entity\Skill")
     */
    private $skill;

    /**
     * @var string $level
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;


    /**
     * Set level
     *
     * @param string $level
     * @return ArticleSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set article
     *
     * @param Guigui\BlogBundle\Entity\Article $article
     * @return ArticleSkill
     */
    public function setArticle(\Guigui\BlogBundle\Entity\Article $article)
    {
        $this->article = $article;
    
        return $this;
    }

    /**
     * Get article
     *
     * @return Guigui\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set skill
     *
     * @param Guigui\BlogBundle\Entity\Skill $skill
     * @return ArticleSkill
     */
    public function setSkill(\Guigui\BlogBundle\Entity\Skill $skill)
    {
        $this->skill = $skill;
    
        return $this;
    }

    /**
     * Get skill
     *
     * @return Guigui\BlogBundle\Entity\Skill 
     */
    public function getSkill()
    {
        return $this->skill;
    }
}