<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StepOne extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('type', 'choice', array(
              'choices' => array(
                  'ar' => 'Advert Response',
                  'pi' => 'Position Inquiry',
                  'pic' => 'Position Inquiry with Contact',
                  'ct' => 'Contact',
                  'ns' => 'Not Sure',
              ),
              'required' => true,
          ))
          ->add('Intials')
          ->add('Surname')
          ->add('Title')
          ->add('Distribution_Method', 'choice', array(
              'choices' => array(
                'email_one' => 'Email (as an actual email)',
                'email_two' => 'Email Attachement',
                'post' => 'Send in the post (A letter)',
              ),
              'required' => true,

          ))
          ->add('Format', 'choice', array(
              'choices' => array (
                  '1' => 'Format 1',
                  '2' => 'Format 2',
                  '3' => 'Do not mind',
              ),
          ))
          ->add('Enclosure_line')
          ->add('Continue', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepOne';
    }
}
