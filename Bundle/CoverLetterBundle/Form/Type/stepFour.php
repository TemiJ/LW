<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class stepFour extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

      $builder
          ->add('requirements_match', 'choice', array(
              'choices' => array(
                  'closely' => 'Closely or close enough',
                  'little' => 'I have very little experience',
              ),
              'required' => true,
          ))
          ->add('Requirements')
          ->add('Continue', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepFour';
    }
}
