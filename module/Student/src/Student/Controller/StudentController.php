<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/25/2018
 * Time: 1:31 PM
 */

namespace Student\Controller;


use Book\Entity\Book;
use Book\Form\BookForm;
use Student\Form\GetBookForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;
use Student\Entity\Student;
use Student\Form\StudentForm;
use Doctrine\ORM\Query\ResultSetMapping;


class StudentController extends AbstractActionController
{

    /**
     * @var DoctrineORMEntityManager
     */
    protected $em;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $students = $this->getEntityManager()->getRepository('Student\Entity\Student')->findAll();
        return new ViewModel(array(
            'students' => $this->getEntityManager()->getRepository('Student\Entity\Student')->findAll(),
        ));

    }

    public function addAction()
    {
        $form = new StudentForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if($request->isPost()){
            $student =new Student();
            $form->setInputFilter($student->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $student->exchangeArray($form->getData());
                //var_dump($form->getData());die();
                //$book = $this->getEntityManager()->find('Book\Entity\Book',$student->__get('bookId'));
                //$student->__set('book',$book);
                $this->getEntityManager()->persist($student);
                $this->getEntityManager()->flush();

                // Redirect to index
                return $this->redirect()->toRoute('student');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('student', array(
                'action' => 'add'
            ));
        }

        $student = $this->getEntityManager()->find('Student\Entity\Student',$id);
        if(!$student){
            return $this->redirect()->toRoute('student',array(
                'action' => 'index',
            ));
        }

        $form = new StudentForm();
        $form->bind($student);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if($request->isPost()){
            $form->setInputFilter($student->getInputFilter());
            $form->setData($request->getPost());

            if($form->isValid()){


                $this->getEntityManager()->flush();
                return $this->redirect()->toRoute('student');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id',0);
        if(!$id){
            return $this->redirect()->toRoute('student');
        }else{
            $student = $this->getEntityManager()->find('Student\Entity\Student',$id);
            $this->getEntityManager()->remove($student);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute('student');
        }
    }

    public function tempAction()
    {
        $student = new Student();
        $student->exchangeArray(array(
            'id'=>1,
           'fristName' => 'mahmoud',
           'lastName'  => 'mohamed',
           'email'     => 'mail@mail.com',
           'address'   => 'address',
        ));
        $book = new Book();
        $book->exchangeArray(array(
            'id'=> 1,
            'name'=>'newBook',
            'author'=>'mahmoud',
        ));
        $student->addBook($book);
        $book = new Book();
        $book->exchangeArray(array(
            'id'=>2,
            'name'=>'book2',
            'author'=>'medo',
        ));
        $student->addBook($book);

        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
        return "Done";
    }

    public function addbookAction()
    {
        $studentId = (int) $this->params()->fromRoute('id', 0);
        if (!$studentId) {
            return $this->redirect()->toRoute('student', array(
                'action' => 'student'
            ));
        }

        $form = new GetBookForm($this->getEntityManager(), $studentId);
        $form->setObjectManager($this->getEntityManager(), $studentId);

        $request = $this->getRequest();
        if($request->isPost()) {

            $bookIds = $this->params()->fromPost('books');
            //var_dump($booksid);die('addBook');
            $student = $this->getEntityManager()->find('Student\Entity\Student',$studentId);
            foreach ($bookIds as $bookId):
                $book = $this->getEntityManager()->find('Book\Entity\Book',$bookId);
                $student->addBook($book);
            endforeach;
            //var_dump($student);die();
            $this->getEntityManager()->persist($student);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute('student');

        }
        return array('form' => $form);
        /**************************/

/*
        $studentId = (int) $this->params()->fromRoute('id', 0);
        if (!$studentId) {
            return $this->redirect()->toRoute('student', array(
                'action' => 'add'
            ));
        }
        $sql = 'SELECT * FROM `book` WHERE `id`NOT IN ( SELECT book_id FROM student_book WHERE student_id = '.$studentId.' )';
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return  new ViewModel(array('studentId'=>$studentId,'result' => $result));*/

    }

    public function getbookAction()
    {
        die("getbook");
        $ids =  $this->params()->fromRoute('id', 0);
        list($studentId, $bookId) = explode('|', $ids);

        $studentId = (int) $studentId;
        $bookId = (int) $bookId;

        $student = $this->getEntityManager()->find('Student\Entity\Student',$studentId);
        $book    = $this->getEntityManager()->find('Book\Entity\Book',$bookId);

        $student->addBook($book);

        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
        //return $this->redirect()->toRoute('student');
        return $this->redirect()->toRoute('student', array(
            'action' => 'addbook',
            'id'     => $studentId,
        ));

    }

    public function deletebookAction()
    {
        $ids =  $this->params()->fromRoute('id', 0);
        list($studentId, $bookId) = explode('|', $ids);

        $studentId = (int) $studentId;
        $bookId = (int) $bookId;

        $student = $this->getEntityManager()->find('Student\Entity\Student',$studentId);
        $book    = $this->getEntityManager()->find('Book\Entity\Book',$bookId);
        if(!($student == null || $book == null )){
            $student->removeBook($book);
            //->getEntityManager()->persist($student);
            $this->getEntityManager()->flush();
        }
        return $this->redirect()->toRoute('student');
    }

}