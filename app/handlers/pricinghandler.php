<?php
class PricingHandler extends RequestHandler{
    public function get(){
        $this->renderView("Pricing");
    }
}