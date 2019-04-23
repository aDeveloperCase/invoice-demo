<?php
namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Form\InvoiceDetailType;
use App\Form\SearchBoxType;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class InvoiceController extends BaseController
{
	public function index(Request $request) {
		$searchBox = $this->createForm(SearchBoxType::class);

		$searchBox->handleRequest($request);
		$wordFilter = "";
		if ($searchBox->isSubmitted() && $searchBox->isValid()) {
			$wordFilter = $searchBox->getData()['searchBox'];
		}

		$entityManager = $this->getDoctrine()->getManager();
		$invoices = $entityManager->getRepository(Invoice::class)->findByFilter($wordFilter);

		return $this->render('invoice/index.html.twig', [
			'invoices' => $invoices,
			'searchBox' => $searchBox->createView()
		]);
	}

	public function new(Request $request, ValidatorInterface $validator) {
		$invoice = new Invoice();
		$invoice->setInvoiceDate(new \DateTime());
		$form = $this->createForm(InvoiceType::class, $invoice);

		$form->handleRequest($request);

		if ($entity = $this->persistEntityFromForm($form, $validator)) {
			return $this->redirectToRoute('create_invoice_detail', array(
				'invoiceId' => $entity->getId()
			));
		}

		return $this->render('invoice/new.html.twig', [
			'form' => $form->createView(),
		]);
	}

	public function edit(Request $request, ValidatorInterface $validator) {
		$invoiceId = $request->get('invoiceId');
		$entityManager = $this->getDoctrine()->getManager();
		$invoice = $entityManager->getRepository(Invoice::class)->find($invoiceId);

		$invoiceForm = $this->createForm(InvoiceType::class, $invoice);
		$invoiceDetailForm = $this->createForm(InvoiceDetailType::class, $invoice->getInvoiceDetail());

		$invoiceForm->handleRequest($request);
		$invoiceDetailForm->handleRequest($request);

		$this->persistEntityFromForm($invoiceForm, $validator);
		$this->persistEntityFromForm($invoiceDetailForm, $validator);

		return $this->render('invoice/edit-full.html.twig', [
			'invoiceForm' => $invoiceForm->createView(),
			'invoiceDetailForm' => $invoiceDetailForm->createView(),
		]);
	}

	public function delete(Request $request) {
		$invoiceId = $request->get('invoiceId');
		$entityManager = $this->getDoctrine()->getManager();
		$invoice = $entityManager->getRepository(Invoice::class)->find($invoiceId);

		$entityManager->remove($invoice);
		$entityManager->flush();

		return $this->redirectToRoute('index_invoice');
	}
}