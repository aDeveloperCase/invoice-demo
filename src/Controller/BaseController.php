<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
	protected function persistEntityFromForm($form, $validator) {
		if (!$form->isSubmitted() || !$form->isValid()) {
			return false;
		}

		$entityManager = $this->getDoctrine()->getManager();
		$entity = $form->getData();
		$errors = $validator->validate($entity);

		if (!count($errors)) {
			$entityManager->persist($entity);
			$entityManager->flush();
		} else {
			$entity = null;
		}

		return $entity;
	}

}