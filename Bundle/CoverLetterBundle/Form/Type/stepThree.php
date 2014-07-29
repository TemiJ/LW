<?php
namespace CLW\Bundle\CoverLetterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class stepThree extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $choices = array(
            'choices' => array(
                'analytical' => 'analytical',
                'communication' => 'communication',
                'computer' => 'computer',
                'group_interaction' => 'contact',
                'language' => 'language',
                'leadership' => 'leadership',
                'mathematical' => 'mathematical',
                'problem_solving' => 'problem solving',
            ),
            'required' => true,
        );

        $builder
          ->add('Skill_set_one', 'choice', $choices)
          ->add('Skill_set_two', 'choice', $choices)
          ->add('Skill_set_three', 'choice', $choices)
          ->add('Continue', 'submit');
    }

    //retruns unquie ID for this form
    public function getName()
    {
        return 'stepThree';
    }
}
