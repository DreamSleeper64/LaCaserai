<?php

namespace HotelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    '1ps. Room' => '1ps. Room',
                    '2ps. Room' => '2ps. Room',
                    'Fam. Room' => 'Family Room',
                ),
            ))
            ->add('media', FileType::class, array(
                'label' => 'Upload image',
                'data_class' => null,
                'mapped' => false,
                'multiple' => true,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HotelBundle\Entity\Room'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hotelbundle_room';
    }


}
