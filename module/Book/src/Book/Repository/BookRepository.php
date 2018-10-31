<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/30/2018
 * Time: 5:11 PM
 */

namespace Book\Repository;

use Book\Entity\Book;
use Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository
{
    public function getUnOwendBooks($studentId)
    {

        $student = $this->getEntityManager()->find('Student\Entity\Student',$studentId);
        //var_dump($student);die('BR');
        $owendBooks = $student->books;
        $allbooks = $this->getEntityManager()->getRepository('Book\Entity\Book')->findAll();

        $unOwendBooks = array_diff($allbooks, $owendBooks->toArray());

        return $unOwendBooks;
    }
}