<?php

use ananasanam\Domain\User;
use ananasanam\Form\Type\UserType;

// Home page
$app->get('/', 'ananasanam\Controller\HomeController::indexAction')
->bind('home');

// Add a user
$app->match('/admin/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView()));
})->bind('admin_user_add');

// Send a message (contact)
$app->match('/contact', function($contact, Request $request) use ($app) {
    $app['dao.contact']->sendMsg($contact);
    $app['session']->getFlashBag()->add('success', 'Your message was sent succesfully.');
    return $app['twig']->render('contact.html.twig', array('contact' => $contact));
})->bind('contact');
