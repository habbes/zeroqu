<?php
class FeaturesHandler extends RequestHandler{
    public function get(){
        $this->renderView("Features");
    }
}