<?php
namespace Album\Model;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


/**
 * album entity
 *
 * @ORM\Entity
 * @ORM\Table(name="album")
 * @property string $fristName
 * @property string $lastName
 * @property string $email
 * @property string $address
 * @property int $id
 */

class Album implements InputFilterAwareInterface
{
    /**
     * @ORM\id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    public $fristName;

    /**
     * @ORM\Column(type="string")
     */
    public $lastName;

    /**
     * @ORM\Column(type="string")
     */
    public $address;

    /**
     * @ORM\Column(type="string")
     */
    public $email;

    protected $inputFilter;


    /**
     * magic getter to expose protected properties
     *
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * magic setter to save protected properties
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    /**
     * convert the object to an array
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * populate from an array
     * @param array $data
     */
    public function exchangeArray  ($data = array())
    {
        $this->id = $data['id'];
        $this->fristName = $data['fristName'];
        $this->lastName = $data['lastName'];
        $this->email = $data['email'];
        $this->address = $data['address'];
    }



    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name'       => 'id',
                'required'   => true,
                'filters'    => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
               'name'       => 'fristName',
               'required'   => true,
               'filters'    => array(
                   array('name' => 'StripTags'),
                   array('name' => 'StringTrim'),
               ),
                'validators' =>array(
                    array(
                        'name'      => 'StringLength',
                        'options'   => array(
                            'encoding'  => 'UTF-8',
                            'min'       => 1,
                            'max'       =>100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name'     => 'lastName',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}