<?php

namespace App\Form;

use DateTime;
use App\Entity\Task;
use Monolog\DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TaskFormTypeDetail extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Content', TextType::Class, [  'label' => 'Description : ','required' => true,'attr' => array(
                'placeholder' => 'Nouvelle tâche', 
                'class' => 'col-5'
            )])
            ->add('Importance', CheckboxType::class, [
                'label'    => ' Important ',
                'required' => false,
                'attr' => array(
                    'class' => 'class="my-autoform-check-label font-weight-bold text-dark mx-5')])

            ->add('Stade', CheckboxType::class, [
                'label'    => 'Active',
                'required' => false,
                'attr' => array(
                    'class' => 'class="my-autoform-check-label font-weight-bold text-dark mx-5')])
                 ->   add('Modifier_la_tache', SubmitType::class, ['label'    => 'Modifier la tache',
                    'attr' => array(
                        'class' => 'class="btn btn-primary mx-5 col-2 my-5')]);
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
