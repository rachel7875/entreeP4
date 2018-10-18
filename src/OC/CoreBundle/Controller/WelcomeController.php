<?php

// src/OC/CoreBundle/Controller/WelcomeController.php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('OCCoreBundle:Welcome:index.html.twig');
    
        return new Response($content);
    
    }
}
