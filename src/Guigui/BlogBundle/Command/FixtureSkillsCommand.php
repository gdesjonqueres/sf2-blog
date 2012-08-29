<?php

namespace Guigui\BlogBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Guigui\BlogBundle\Entity\Skill;

class FixtureSkillsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('guiguiblog:fixture:skills');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // On récupère l'EntityManager
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        // Liste des noms de compétences à ajouter
        $names = array('Doctrine', 'Formulaire', 'Twig');
        foreach($names as $i => $name)
        {
            $output->writeln('Creation de la competence : '. $name);
            // On crée la compétence
            $skills[$i] = new Skill();
            $skills[$i]->setName($name);
            // On la persiste
            $em->persist($skills[$i]);
        }
        $output->writeln('Enregistrement des competences...');
        // On déclenche l'neregistrement
        $em->flush();
        // On retourne 0 pour dire que la commande s'est bien exécutée
        return 0;
    }
}