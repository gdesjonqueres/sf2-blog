<?php

namespace Guigui\BlogBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Guigui\BlogBundle\Entity\Category;

class FixtureCategoriesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('guiguiblog:fixture:categories');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // On récupère l'EntityManager
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        // Liste des noms de catégorie à ajouter
        $names = array('Symfony2', 'Doctrine2', 'Tutoriel', 'Evenement');
        foreach ($names as $i => $name)
        {
            $output->writeln('Creation de la categorie : '.$name);
            // On crée la catégorie
            $categories[$i] = new Category();
            $categories[$i]->setName($name);
            // On la persiste
            $em->persist($categories[$i]);
        }
        $output->writeln('Enregistrement des categories...');
        // On déclenche l'neregistrement
        $em->flush();
        // On retourne 0 pour dire que la commande s'est bien exécutée
        return 0;
    }
}