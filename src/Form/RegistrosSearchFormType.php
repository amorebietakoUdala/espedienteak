<?php

namespace App\Form;

use App\Entity\Tipo;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrosSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ordenEntradaSalida', null,[
                'label' => 'registro.orden_entrada_salida',
                'required' => false,
            ])
            ->add('tipo', EntityType::class,[
                'class' => Tipo::class,
                'label' => 'registro.tipo',
                'required' => false,
            ])
            ->add('anno', null,[
                'label' => 'registro.anno',
                'required' => false,
            ])
            ->add('descripcion', null,[
                'label' => 'registro.descripcion',
                'required' => false,
            ])
            // ->add('fechaFin', DateType::class, [
            //     'label' => 'regexpedientes.fechaFin',
            //     'widget' => 'single_text',
            //     'html5' => false,
            //     'format' => 'yyyy-MM-dd',
            //     'required' => false,
            // ])
            // ->add('departamento', null, [
            //     'label' => 'regexpedientes.departamento',
            //     'required' => false,
            // ])
            ->add('dni', null, [
                'label' => 'registro.dni',
                'required' => false,
            ])
            // ->add('solicitante', null, [
            //     'label' => 'regexpedientes.solicitante',
            //     'required' => false,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'readonly' => false,
        ]);
    }
}
