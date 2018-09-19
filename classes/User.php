<?php

/**
 * User class 
 *
 * @author roberto di biase
 */
class User {

    /**
     * @var id
     * @type integer
     */
    private $id;

    /**
     * @var firstName
     * @type string
     */
    private $firstName;
    
    /**
     * @var lastName
     * @type string
     */
    private $lastName;
    
    /**
     * @var email
     * @type string
     */
    private $email;
    
    /**
     * @var password
     * @type string
     */
    private $password;
    
    
    
    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
