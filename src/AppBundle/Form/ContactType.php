<?php

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
            ])
            ->add('street', TextType::class, [
                'required' => true,
            ])
            ->add('postcode', TextType::class, [
                'required' => true,
            ])
            ->add('city', TextType::class, [
                'required' => true,
            ])
            ->add('country', TextType::class, [
                'required' => true,
            ])
            ->add('phone', TelType::class, [
                'required' => true,
            ])
            ->add('birthday', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd.MM.y',

                'attr' => [
                    'class' => 'date-picker',
                ],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
            ])
            ->add('pictureFile', VichImageType::class, [
                'required' => false,
                'download_uri' => false,
                'asset_helper' => false,
                'delete_label' => 'Remove picture',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
