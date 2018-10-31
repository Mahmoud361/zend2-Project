<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/25/2018
 * Time: 2:51 PM
 */

namespace Student\Form;

use Zend\Form\Form;

class StudentForm extends Form
{

    /**
     * StudentForm constructor.
     */
    public function __construct()
    {
        parent::__construct('student');

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden'
        ));

        $this->add(array(
            'name' => 'fristName',
            'type' => 'text',
            'options' => array(
                'label' => 'fristName',
            ),
        ));

        $this->add(array(
            'name' => 'lastName',
            'type' => 'text',
            'options' => array(
                'label' => 'lastName',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name' => 'address',
            'type' => 'text',
            'options' => array(
                'label' => 'Address',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Go',
                'id'    => 'submitbutton',
            ),
        ));


    }
}