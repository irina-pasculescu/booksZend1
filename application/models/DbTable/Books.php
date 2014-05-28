<?php

class Application_Model_DbTable_Books extends Zend_Db_Table_Abstract
{
    /**
     * @var string
     */
    protected $_name = 'books';

    /**
     * @param $id
     *
     * @return array
     * @throws Exception
     */
    public function getBook($id)
    {
        $id  = (int)$id;
        $row = $this->fetchRow('id = ' . $id);

        if (!$row) {
            throw new Exception("Could not find row $id");
        }

        return $row->toArray();
    }

    /**
     * @param $author
     * @param $title
     */
    public function addBook($author, $title)
    {
        $data = array(
            'author' => $author,
            'title'  => $title,
        );

        $this->insert($data);
    }

    /**
     * @param $id
     * @param $author
     * @param $title
     */
    public function updateBook($id, $author, $title)
    {
        $data = array(
            'author' => $author,
            'title'  => $title,
        );

        $this->update($data, 'id = ' . (int)$id);
    }

    /**
     * @param $id
     */
    public function deleteBook($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

