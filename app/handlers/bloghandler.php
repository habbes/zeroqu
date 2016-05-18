<?php
class BlogHandler extends RequestHandler{
    public function get(){
        $this->renderView("Blog");
    }
}