<?php

// src/OC/CoreBundle/Controller/WelcomeController.php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('OCCoreBundle:Rate');

        $rateEnfant = $repository->findOneBy(array('rateName' => 'enfant'));
        $rateNormal= $repository->findOneBy(array('rateName' => 'normal'));
        $rateSenior = $repository->findOneBy(array('rateName' => 'senior'));
        $rateReduit = $repository->findOneBy(array('rateName' => 'réduit'));

        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('OCCoreBundle:Duration');
        $durationforDemiJournee= $repository->findOneBy(array('durationName' => 'Demi-Journée'));


        return $this->render('OCCoreBundle:Welcome:index.html.twig', array(
            'rateEnfant' => $rateEnfant,
            'rateNormal' => $rateNormal,
            'rateSenior' => $rateSenior,
            'rateReduit' => $rateReduit,
            'durationforDemiJournee' => $durationforDemiJournee,

        ));
    
    }


}
