<?php
namespace App\Form;

use App\Entity\Client;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InvoiceType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('invoiceDate', DateType::class, [
				'format' => 'dd MM yyyy',
			])
			->add('invoiceNumber', IntegerType::class)
			->add('client', EntityType::class, [
				'class' => Client::class,
				'choice_label' => function (Client $client) {
					return $client->getFirstName() . ' ' . $client->getLastName();
				}
			])
			->add('save', SubmitType::class, ['label' => 'Create Invoice'])
		;


	}
}