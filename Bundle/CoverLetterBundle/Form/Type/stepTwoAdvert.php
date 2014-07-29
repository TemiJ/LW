<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class stepTwoAdvert extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('Date')
          ->add('Place_Advert_Seen')
          ->add('Company_Name')
          ->add('Name_Of_Position_Applied_for')
          ->add('Continue', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepTwoAdvert';
    }
}
