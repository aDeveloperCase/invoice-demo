<?php
namespace App\Controller;

use App\Entity\InvoiceDetail;
use App\Entity\Invoice;
use App\Form\InvoiceDetailType;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class InvoiceDetailController extends BaseController
{
	public function new(Request $request, ValidatorInterface $validator) {
		$invoice = new InvoiceDetail();
		$invoiceId = $request->query->get('invoiceId');

		$form = $this->createForm(InvoiceDetailType::class, $invoice);
		$form->get('invoiceId')->setData($invoiceId);

		$form->handleRequest($request);

		$errors = [];
		if ($form->isSubmitted() || $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$invoiceDetail = $form->getData();

			$errors = $validator->validate($invoiceDetail);

			if (!count($errors)) {
				$invoice = $entityManager->getRepository(Invoice::class)->find($invoiceId);

				$invoice->setInvoiceDetail($invoiceDetail);

				$entityManager->persist($invoice);
				$entityManager->flush();

				return $this->redirectToRoute('index_invoice');
			}

		}

		return $this->render('invoice-detail/new.html.twig', [
			'form' => $form->createView(),
			'invoiceId' => $invoiceId
		]);
	}
}