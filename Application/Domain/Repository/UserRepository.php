<?php

namespace Domain\Repository;

/**
 * A user repository
 *
 * @author Julian Kleinhans <typo3@kj187.de>
 * @package Domain\Repository
 */
class UserRepository extends \LEA\Persistence\Repository {

    /**
     * @return void
     */
    public function addUser() {
        $test = new \Domain\Model\UserModel();
        $test->setFirstname('Hans');
        $test->setLastname('Mustermann');

        $this->entityManager->persist($test);
        $this->entityManager->flush();
    }
}

?>
