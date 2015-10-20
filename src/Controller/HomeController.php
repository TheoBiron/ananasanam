<?php

namespace ananasanam\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    public function indexAction(Application $app) {
        return $app['twig']->render('index.html.twig');
    }
}
