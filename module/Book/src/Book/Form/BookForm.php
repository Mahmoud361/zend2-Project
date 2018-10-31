<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/25/2018
 * Time: 2:51 PM
 */

namespace Book\Form;

use Zend\Form\Form;

class BookForm extends Form
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
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Name',
            ),
        ));

        $this->add(array(
            'name' => 'author',
            'type' => 'text',
            'options' => array(
                'label' => 'Author',
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