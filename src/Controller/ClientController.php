<?php
namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Form\SearchBoxType;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClientController extends BaseController
{
	public function index(Request $request, ValidatorInterface $validator) {
		$client = new Client();
		$form = $this->createForm(ClientType::class, $client);
		$searchBox = $this->createForm(SearchBoxType::class);
		
		$form->handleRequest($request);
		$searchBox->handleRequest($request);

		$wordFilter = "";
		if ($searchBox->isSubmitted() && $searchBox->isValid()) {
			$wordFilter = $searchBox->getData()['searchBox'];
		}

		$this->persistEntityFromForm($form, $validator);

		$entityManager = $this->getDoctrine()->getManager();
		$clients = $entityManager->getRepository(Client::class)->findByFilter($wordFilter);

		return $this->render('client/index.html.twig', [
			'form' => $form->createView(),
			'searchBox' => $searchBox->createView(),
			'clients' => $clients,
		]);
	}

	public function new(Request $request, ValidatorInterface $validator) {
		$client = new Client();
		$form = $this->createForm(ClientType::class, $client);
		
		$form->handleRequest($request);

		if ($this->persistEntityFromForm($form, $validator)) {
			return $this->redirectToRoute('index');
		}

		return $this->render('client/new.html.twig', [
			'form' => $form->createView(),
		]);
	}

	public function edit(Request $request, ValidatorInterface $validator) {
		$clientId = $request->get('clientId');
		$entityManager = $this->getDoctrine()->getManager();
		$client = $entityManager->getRepository(Client::class)->find($clientId);

		$form = $this->createForm(ClientType::class, $client);

		$form->handleRequest($request);

		if ($entity = $this->persistEntityFromForm($form, $validator)) {
			return $this->redirectToRoute('index_client');
		}

		return $this->render('client/edit.html.twig', [
			'form' => $form->createView(),
		]);
	}

	public function delete(Request $request) {
		$clientId = $request->get('clientId');
		$entityManager = $this->getDoctrine()->getManager();
		$client = $entityManager->getRepository(Client::class)->find($clientId);

		$entityManager->remove($client);
		$entityManager->flush();

		return $this->redirectToRoute('index_client');
	}
}