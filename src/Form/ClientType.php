<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('firstName', TextType::class)
			->add('lastName', TextType::class)
			->add('save', SubmitType::class, [
				'label' => 'Add Client',
				'attr' => [
					'class' => 'button'
				],
			])
		;
	}
}