<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class stepTwoContact extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('Contact_first_name')
          ->add('Contact_last_name')
          ->add('Contacts_position_company')
          ->add('Company_Name')
          ->add('Position_name')
          ->add('Continue', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepTwoContact';
    }
}
