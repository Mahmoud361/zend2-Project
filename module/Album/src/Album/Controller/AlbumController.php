<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;
use Doctrine\ORM\EntityManager;

class AlbumController extends AbstractActionController
{
    protected $albumTable;

    protected $em; //doctrine

    public function getEntityManager()
    {

        if ($this->em === null) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'albums' => $this->getEntityManager()->getRepository('Album\Model\Album')->findAll(),
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if($request->isPost()){
            $album =new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getEntityManager()->persist($album);
                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }

        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
//        try {
//            $album = $this->getAlbumTable()->getAlbum($id);
//        }
//        catch (\Exception $ex) {
//            return $this->redirect()->toRoute('album', array(
//                'action' => 'index'
//            ));
//        }
        $album = $this->getEntityManager()->find('Album\Model\Album', $id);
        if(!$album){
            return $this->redirect()->toRoute('album',array(
                'action' => 'index'
            ));
        }

        $form  = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
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
        if(!$id){// if the id is not passed return to view albums page indexpage
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del', 'No');

            if($del == 'Yes'){
                $id = (int) $request->getPost('id');
                //die($id);
                $album = $this->getEntityManager()->find('Album\Model\Album', $id);
                $this->getEntityManager()->remove($album);
                $this->getEntityManager()->flush();
            }

            return $this->redirect()->toRoute('album');
        }

        return array( //the request is GET retrive the album to aview
            'id'    => $id,
            'album' => $this->getAlbumTable()->getAlbum($id),
        );
    }






    public function getAlbumTable() //like afactory to get instance  albumtale
    {
        if (!$this->albumTable) {
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Album\Model\AlbumTable');
        }
        return $this->albumTable;
    }
}