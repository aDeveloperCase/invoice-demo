<?php
namespace App\Form;

use App\Entity\Invoice;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InvoiceDetailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$numberTypeOptions = [
			'grouping' => true,
			'scale' => 2
		];

		$builder
			->add('invoiceId', HiddenType::class, ['mapped' => false])
			->add('description', TextareaType::class)
			->add('quantity', IntegerType::class)
			->add('amount', NumberType::class, $numberTypeOptions)
			->add('VATAmount', NumberType::class, $numberTypeOptions)
			->add('totalAmountAndVAT', NumberType::class, $numberTypeOptions)
			->add('save', SubmitType::class, ['label' => 'Add invoice details'])
		;
	}
}