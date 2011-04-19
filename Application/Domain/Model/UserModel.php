<?php
declare(ENCODING = 'utf-8');
namespace Domain\Model;

/**
 * A user model
 *
 * @Entity
 * @Table(name="Users")
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package Domain\Model
 */
class UserModel {

    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $identifier = '';

    /**
     * @Column(type="string")
     */
    protected $firstname = '';

    /**
     * @Column(type="string")
     */
    protected $lastname = '';

    /**
     * @return void
     */
    public function getIdentifier() {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname() {
        return $this->lastname;        
    }

    /**
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    /**
     * @param string $lastname
     * @return void
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

}

?>