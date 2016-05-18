<?php
class LearnmoreHandler extends RequestHandler{
    public function get(){
        $this->renderView("Learnmore");
    }
}