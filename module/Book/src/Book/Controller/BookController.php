<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud Mohamed
 * Date: 10/28/2018
 * Time: 10:42 AM
 */

namespace Book\Controller;

use Student\Form\StudentForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;
use Book\Entity\Book;
use Book\Form\BookForm;

class BookController extends AbstractActionController
{
    /**
     * @var Doctrine Entity Manager
     */
    protected $em;

    public function getEntityManager()
    {
        if ($this->em === null){
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        //die("Book");
        return new ViewModel(array(
            'books' => $this->getEntityManager()->getRepository('Book\Entity\Book')->findAll(),
        ));
    }

    public function addAction()
    {
        $form = new BookForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $book = new Book();
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $book->exchangeArray($form->getData());
                $this->getEntityManager()->persist($book);
                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('book');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'add'
            ));
        }


        $book = $this->getEntityManager()->find('Book\Entity\Book', $id);
        if(!$book){
            return $this->redirect()->toRoute('book',array(
                'action' => 'index'
            ));
        }

        $form  = new BookForm();
        $form->bind($book);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($book->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('book');
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
        if(!$id) {
            return $this->redirect()->toRoute('book');
        }else {
            $book = $this->getEntityManager()->find('Book\Entity\Book',$id);

            $this->getEntityManager()->remove($book);
            $this->getEntityManager()->flush();
            return $this->redirect()->toRoute('book');
        }
    }

}