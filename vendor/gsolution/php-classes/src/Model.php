<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gbd;

/**
 * Description of Model
 *
 * @author glei-
 */
class Model {

    private $values = [];

    public function __call($name, $args) {
        $method = substr($name, 0, 3);
        $fieldName = substr($name, 3, strlen($name));
        switch ($method) {
            case "get":
                return $this->values[$fieldName];

                break;
            case "set":
                return $this->values[$fieldName] = $args[0];

                break;
        }
    }
    public function setData($data = array()) {
        foreach ($data as $key => $value) {
            $this->{"set".$key}($value);
        }
    }
public function getValues(){
    return $this-> values;
}
}
