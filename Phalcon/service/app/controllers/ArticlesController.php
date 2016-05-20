<?php

class ArticlesController extends ControllerApi
{

    public function indexAction()
    {
        $where = $this->request->get('where');
        $order = $this->request->get('order');
        $limit = $this->request->get('limit');
        $page = $this->request->get('page');
        
    }
    
}

