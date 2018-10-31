<?php
namespace Album\Model;

use Zend\Db\TableGateway\TableGateway;

class AlbumTable
{
    protected $tableGateway;

    /**
     * AlbumTable constructor.
     * @param $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getAlbum($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id'=> $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("could not find row $id");
        }
        return $row;
    }

    public function saveAlbum(Album $album)
    {
        $data = array(
            'fristName'    => $album->fristName,
            'lastName'     => $album->lastName,
            'address'   => $album->address,
            'email'     => $album->email,
        );

        $id = (int) $album->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getAlbum($id)){
                $this->tableGateway->update($data, array('id'=> $id));
            }else{
                throw new \Exception('album id does not exist');
            }
        }
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

}
