<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171019181110_seed_user_table extends AbstractMigration
{
    const USER_FIXTURE_FILE_PATH = __DIR__ . '/../fixtures/users.csv';
    const CSV_FILE_USERNAME_INDEX = 0;
    const CSV_FILE_EMAIL_INDEX = 1;

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->updateUserTable('INSERT INTO user (username, email) VALUES (:username, :email)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->updateUserTable('DELETE FROM user WHERE username = :username AND email = :email LIMIT 1');
    }

    /**
     * @param string $sql
     */
    private function updateUserTable($sql)
    {
        $usersData = $this->getUsersDataFromCsvFixture();
        foreach ($usersData as $userData) {
            $this->addSql($sql, $userData);
        }
    }

    /**
     * @return array
     */
    private function getUsersDataFromCsvFixture()
    {
        $fixtureCsvUsersFile = fopen(self::USER_FIXTURE_FILE_PATH, 'r');

        $usersData = [];
        while ($oneUserData = fgetcsv($fixtureCsvUsersFile, 1000, ';')) {
            $usersData[] = [
                'username' => $oneUserData[self::CSV_FILE_USERNAME_INDEX],
                'email' => $oneUserData[self::CSV_FILE_EMAIL_INDEX],
            ];
        }
        fclose($fixtureCsvUsersFile);

        return $usersData;
    }
}
