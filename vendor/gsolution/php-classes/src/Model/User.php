<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Gbd\Model;

/**
 * Description of User
 *
 * @author glei-
 */
use \Gbd\DB\Sql;
use \Gbd\Model;

class User extends Model {
    const SESSION = "User";

    //put your code here
    public static function login($login, $password) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin =:LOGIN", array(
            ":LOGIN" => $login
        ));
        if (count($results) === 0) {
            throw new \Exception("Usuario inexistente ou senh invalida.");
        }
        $data = $results[0];
        if (password_verify($password, $data["despassword"]) === TRUE) {
            $user = new User();
            $user->setData($data);
            $_SESSION[User::SESSION] = $user->getValues();
            return $user;
        } else {
            throw new \Exception("Usuario inexistente ou senh invalida.");
        }
    }

    public static function verifyLogin($inadmin = true) {
        if (!isset(
                        $_SESSION[User::SESSION]) || !$_SESSION[User::SESSION] || !(int) $_SESSION[User::SESSION]["iduser"] > 0 || (bool) $_SESSION[User::SESSION]["inadmin"] !== $inadmin
        ) {
            header("Location:/admin/login");
            exit;
        }
    }

    public static function logout() {
        $_SESSION[User::SESSION] = NULL;
    }

}
