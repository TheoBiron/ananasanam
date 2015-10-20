<?php
namespace ananasanam\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder = $app['form.factory']->createBuilder('form')
			->add('name', 'text', array(
				'required' => true,
				'constraints' => array(new Assert\NotBlank()),
				'attr' => array('class' => 'form-control',
								'placeholder' => 'Name')
			))

			->add('email', 'text', array(
				'required' => true,
				'constraints' => array(new Assert\Email(), new Assert\NotBlank()),
				'attr' => array('class' => 'form-control',
								'placeholder' => 'Email')
			))

			->add('message', 'textarea', array(
				'required' => true,
				'constraints' => array(new Assert\NotBlank()),
				'attr' => array('class' => 'form-control',
								'placeholder' => 'Enter your message')
			))

			->getForm();

		$builder->handleRequest($request);

		if($builder->isValid()) {
			$data = $form->getData();

			$message = \Swift_Message::newInstance()
			->setSubject('Contact Message')
			->setFrom(array($data['email'] => $data['name']))
			->setTo(array('yami-theo@hotmail.fr'))
			->setBody($data['message']);

			$app['mailer']->send($message);
		}	
	}
}
