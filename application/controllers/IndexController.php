<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $books             = new Application_Model_DbTable_Books();
        $this->view->books = $books->fetchAll();
    }

    public function addAction()
    {
        $form = new Application_Form_Book();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $author = $form->getValue('author');
                $title  = $form->getValue('title');

                $books = new Application_Model_DbTable_Books();
                $books->addBook($author, $title);

                $this->_helper->redirector('index');
            } else {

                $form->populate($formData);
            }
        }
    }

    public function editAction()
    {
        $form = new Application_Form_Book();
        $form->submit->setLabel('Save');

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $id     = (int)$form->getValue('id');
                $author = $form->getValue('author');
                $title  = $form->getValue('title');

                $books = new Application_Model_DbTable_Books();
                $books->updateBook($id, $author, $title);

                $this->_helper->redirector('index');

            } else {

                $form->populate($formData);
            }

        } else {

            $id = $this->_getParam('id', 0);

            if ($id > 0) {

                $books = new Application_Model_DbTable_Books();
                $form->populate($books->getBook($id));
            }

        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {

            $del = $this->getRequest()->getPost('del');

            if ($del == 'Yes') {

                $id    = $this->getRequest()->getPost('id');
                $books = new Application_Model_DbTable_Books();
                $books->deleteBook($id);
            }

            $this->_helper->redirector('index');

        } else {

            $id = $this->_getParam('id', 0);

            $books            = new Application_Model_DbTable_Books();
            $this->view->book = $books->getBook($id);
        }

    }


}







