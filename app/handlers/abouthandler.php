<?php
class AboutHandler extends RequestHandler{
    public function get(){
        $this->renderView("About");
    }
}