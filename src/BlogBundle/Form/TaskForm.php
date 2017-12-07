<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 05.12.2017
 * Time: 13:41
 */

namespace BlogBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TaskForm extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('task', TextType::class, [
            'label' => 'Task',
            'label_attr' => [
                'class' => 'custom-class-name'
            ],
            'attr' => [
                'placeholder' => 'введите имя задачи'
            ]
        ]);


        $builder->add('description', TextareaType::class,
            [
                'label' => 'Description'

            ]);
        $builder->add('submit', SubmitType::class,
            [
                'label' => 'Отправить'
            ]);



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Form\Models\TaskModel'
        ));
    }
}