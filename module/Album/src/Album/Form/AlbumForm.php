<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{

    /**
     * AlbumForm constructor.
     */
    public function __construct($name = null)
    {
        //to ignore the name that passed
        parent::__construct('album');

        $this->add(array(
            'name' =>'id',
            'type' =>'Hidden',
        ));

        $this->add(array(
            'name'=>'fristName',
            'type'=>'Text',
            'options'=>array(
                'label'=>'fristName',
            ),
        ));

        $this->add(array(
            'name'=>'lastName',
            'type'=>'Text',
            'options'=>array(
                'label'=>'lastName',
            ),
        ));
        $this->add(array(
            'name'=>'address',
            'type'=>'Text',
            'options'=>array(
                'label'=>'address',
            ),
        ));
        $this->add(array(
            'name'=>'email',
            'type'=>'Text',
            'options'=>array(
                'label'=>'email',
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