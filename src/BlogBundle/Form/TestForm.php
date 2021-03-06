<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 05.12.2017
 * Time: 15:10
 */

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TestForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')->add('body');

        $builder->add('submit', SubmitType::class, [
            'label' => 'Отправить'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
    }
}