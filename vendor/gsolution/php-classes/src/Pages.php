<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gbd;

use Rain\Tpl;

class Pages {

    private $tpl;
    private $options = [];
    private $defaults = [
        "data" => []
    ];
 private function setData($data=array()) {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }
    public function __construct($opts = array()) {
        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views/",
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "views-cache/",
            "debug" => FALSE,
        );


        Tpl::configure($config);
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        $this->tpl->draw("header");
    }
   
    public function setTpl($nome, $data = array(), $returnHTML = false) {
        $this->setData($data);
        return $this->tpl->draw($nome, $returnHTML);
    }

    public function __destruct() {
        $this->tpl->draw("footer");
    }

}
