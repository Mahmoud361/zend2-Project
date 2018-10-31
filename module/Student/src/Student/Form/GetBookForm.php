<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/30/2018
 * Time: 2:09 PM
 */

namespace Student\Form;

use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GetBookForm extends Form implements ObjectManagerAwareInterface
{
    public $studentId;
    protected $objectManager;

    public function __construct($om, $stdId)
    {
        parent::__construct('student');

        $this->objectManager = $om;
        $this->studentId = $stdId;

//var_dump($this->studentId);die();

        $this->add(array(
            'name' => 'studentId',
            'type' => 'hidden',
            'value'=> $stdId,
        ));

        $this->add( array(
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'books',
            'attributes' => array(
                'style'=>'width:100px',
             ),
            'options' => array(
                    'object_manager' => $this->getObjectManager(),
                    'target_class'   => 'Book\Entity\Book',
                    'property'       => 'author',// property the will be shown in view **either the property f label generatoe will be shown
                    'is_method'      => true,
                    'find_method'    => array(
                        'name'  => 'getUnOwendBooks',
                        'params'=> array(
                            'studentId'    => $this->studentId,
                        ),
                    ),
                    'label_generator' => function ($targetEntity) {
                        return $targetEntity->getName() . ' Writen By ' . $targetEntity->getAuthor();
                    },
                ),
            )
        );

        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'addbook',
                'id'    => 'submitbutton',
            ),
        ));
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getObjectManager()
    {
        return $this->objectManager == null? die('empt ObjectManager') : $this->objectManager;
    }
}