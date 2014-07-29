<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class stepTwoPositionInquiry extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('Company_Name')
          ->add('Position_Name')
          ->add('Industry_Name')
          ->add('Continue', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepTwoPositionInquiry';
    }
}
