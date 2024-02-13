<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegExpedienteSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', null,[
                'label' => 'regexpedientes.kodea',
                'required' => false,
            ])
            ->add('descripcion', null,[
                'label' => 'regexpedientes.descripcion',
                'required' => false,
            ])
            ->add('tipoexpediente', null,[
                'label' => 'regexpedientes.tipoexpediente',
                'required' => false,
            ])
            ->add('fechaInicio', DateType::class, [
                'label' => 'regexpedientes.fechaInicio',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            ->add('fechaFin', DateType::class, [
                'label' => 'regexpedientes.fechaFin',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            // ->add('departamento', null, [
            //     'label' => 'regexpedientes.departamento',
            //     'required' => false,
            // ])
            ->add('dni', null, [
                'label' => 'regexpedientes.dni',
                'required' => false,
            ])
            ->add('solicitante', null, [
                'label' => 'regexpedientes.solicitante',
                'required' => false,
            ])
            ->add('finalizado', ChoiceType::class, [
                'label' => 'regexpedientes.finalizado',
                'required' => false,
                'placeholder' => 'label.choose',
                'choices' => [
                    'label.yes' => true,
                    'label.no' => false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'readonly' => false,
        ]);
    }
}
