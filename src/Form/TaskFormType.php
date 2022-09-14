<?php

namespace App\Form;

use DateTime;
use App\Entity\Task;
use Monolog\DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Content', TextType::Class, [  'label' => ' ','required' => true,'attr' => array(
                'placeholder' => 'Nouvelle tâche', 
                'class' => 'col-5'
            )])
            ->add('Importance', CheckboxType::class, [
                'label'    => ' Important ',
                'required' => false,
                'attr' => array(
                    'class' => 'class="my-autoform-check-label font-weight-bold text-dark mx-5')])

            ->add('CreatedAt', HiddenType::class,)
            ->add('ModifiedAt', HiddenType::class)
            ->add('Stade', HiddenType::class)
            // ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
