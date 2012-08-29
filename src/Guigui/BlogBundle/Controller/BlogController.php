<?php

namespace Guigui\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Guigui\BlogBundle\Entity;

class BlogController extends Controller
{

    public function indexAction($page)
    {
        if ($page < 1) {
            throw $this->createNotFoundException(
                'Page inexistante (page = ' . $page . ')');
        }

        // Les articles :
        $articles = array(array('title' => 'Mon weekend a Phi Phi Island !',
                'id' => 1,
                'author' => 'winzou',
                'content' => 'Ce weekend était trop bien. Blabla...',
                'date' => new \Datetime()),
            array('title' => 'Repetition du National Day de Singapour',
                'id' => 2,
                'author' => 'winzou',
                'content' => 'Bientôt prêt pour le jour J. Blabla...',
                'date' => new \Datetime()),
            array('title' => 'Chiffre d\'affaire en hausse',
                'id' => 3,
                'author' => 'M@teo21',
                'content' => '+500% sur 1 an, fabuleux. Blabla...',
                'date' => new \Datetime()));

        return $this->render('GuiguiBlogBundle:Blog:index.html.twig',
            array('articles' => $articles));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $article = $em->getRepository('GuiguiBlogBundle:Article')->find($id);
        if ($article === null) {
            throw $this->createNotFoundException('Article[id=' . $id . '] inexistant.');
        }

        $comments = $em->getRepository('GuiguiBlogBundle:Comment')->findAll();

        $articleSkills = $em->getRepository('GuiguiBlogBundle:ArticleSkill')
                            ->findByArticle($article->getId());

        return $this->render('GuiguiBlogBundle:Blog:view.html.twig',
            array(
                'article'       => $article,
                'comments'      => $comments,
                'articleSkills' => $articleSkills
            ));
    }

    public function addAction()
    {
        // Création de l'entité
        $article = new Entity\Article();
        $article->setTitle('Mon dernier weekend');
        $article->setAuthor('Bibi');
        $article->setContent("C'était vraiment super et on s'est bien amusé.");

        // Création de l'entité Image
        $image = new Entity\Image();
        $image->setUrl(
            'http://uploads.siteduzero.com/icones/478001_479000/478657.png');
        $image->setAlt('Logo Symfony2');
        $article->setImage($image);

        // Creation de commentaires
        $comment1 = new Entity\Comment();
        $comment1->setAuthor('Toto')
                 ->setContent('J\'adore Symfony !')
                 ->setArticle($article);
        $comment2 = new Entity\Comment();
        $comment2->setAuthor('Jean-Robert')
                 ->setContent('Moi aussi !')
                 ->setArticle($article);

        $em = $this->getDoctrine()->getEntityManager();

        $em->persist($article);
        $em->persist($image);
        $em->persist($comment1);
        $em->persist($comment2);
        $em->flush();

        // Creation relation ArticleSkill
        $skills = $em->getRepository('GuiguiBlogBundle:Skill')->findAll();
        foreach ($skills as $i => $skill) {
            $articleSkill = new Entity\ArticleSkill();
            $articleSkill->setArticle($article)
                         ->setSkill($skill)
                         ->setLevel('Expert');
            $em->persist($articleSkill);
        }
        $em->flush();

        if ($this->get('request')->getMethod() == 'POST') {
            $this->get('session')
                 ->getFlashBag()
                 ->add('notice', 'Article bien enregistré');
            return $this->redirect(
                $this->generateUrl('GuiguiBlog_view', array('id' => 5)));
        }
        return $this->render('GuiguiBlogBundle:Blog:add.html.twig');
    }

    public function editAction($id)
    {
        // On récupère l'EntityManager
        $em = $this->getDoctrine()->getEntityManager();
        // On récupère l'entité correspondant à l'id $id
        $article = $em->getRepository('GuiguiBlogBundle:Article')->find($id);
        if($article === null) {
            throw $this->createNotFoundException('Article[id='.$id.'] inexistant.');
        }
        // On récupère toutes les catégories :
        $categories = $em->getRepository('GuiguiBlogBundle:Category')->findAll();
        // On boucle sur les catégories pour les lier à l'article
        foreach ($categories as $category) {
            $article->addCategory($category);
        }
        // Inutile de persister l'article, on l'a récupéré avec Doctrine
        // Etape 2 : On déclenche l'enregistrement
        $em->flush();

        return new Response('OK');

//         return $this->render('GuiguiBlogBundle:Blog:edit.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('GuiguiBlogBundle:Blog:delete.html.twig');
    }

    public function menuAction($number)
    {
        $list = array(2 => 'Mon dernier weekend !',
            5 => 'Sortie de Symfony2.1',
            9 => 'Petit test');
        return $this->render('GuiguiBlogBundle:Blog:menu.html.twig',
            array('list_articles' => $list));
    }
}
