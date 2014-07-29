<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class stepFive extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

      $builder
          ->add('Date', 'date', array(
              'input' => 'datetime',
              'widget' => 'choice',
              //'help' => 'This is the date you want to appear on your letter',
          ))
          -> add('Address_line_one')
          -> add('Address_line_two')
          -> add('City')
          -> add('Postcode')
          -> add('Email', 'text')
          -> add('Telephone')
          -> add('Mobile')

          -> add('Org_Address_line_one')
          -> add('Org_Address_line_two')
          -> add('Org_City')
          -> add('Org_Postcode')
          -> add('Org_Email', 'text')
          ->add('Create Letter', 'submit');
  }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepFive';
    }
}
