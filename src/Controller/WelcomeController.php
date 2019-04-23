<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WelcomeController extends AbstractController
{

	public function index() {
		$number = random_int(0, 100);

		return $this->render('welcome/index.html.twig', [
			'number' => $number,
		]);
	}
}