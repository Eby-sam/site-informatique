<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    public const TABLE = 'user';

    /**
     * Return all available users.
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE);

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::makeUser($data);
            }
        }
        return $users;
    }


    /**
     * Return current users count.
     * @return int
     */
    public static function getUsersCount(): int
    {
        $result = DB::getPDO()->query(" SELECT count(*) as cnt FROM " . self::TABLE);
        return $result ? $result->fetch()['cnt'] : 1;
    }

    public static function getUserByMail(string $mail): ?User
    {
        $stmt = DB::getPDO()->prepare(" SELECT * FROM " . self::TABLE . " WHERE email = :email LIMIT 1");
        $stmt->bindParam('email', $mail);
        return $stmt->execute() ? self::makeUser($stmt->fetch()): null;

    }

    /**
     * Return a user based on it us id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
       $request = DB::getPDO()->query(" SELECT * FROM " . self::TABLE. " WHERE id = $id");
       return $request ? self::makeUser($request->fetch()): null;
    }

    /**
     * @param array $data
     * @return User
     */
    private static function makeUser(array $data): User
    {
        return (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setPseudo($data['pseudo'])
            ->setPassword($data['password']);
    }
}