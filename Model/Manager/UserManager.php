<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

final class UserManager
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
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE);
        return $result ? $result->fetch()['cnt'] : 0;
    }



    /**
     * Return a user based on it us id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $result = DB::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeUser($result->fetch()) : null;
    }

    /**
     * Check if a user exists.
     * @param int $id
     * @return bool
     */
    public static function userExists(int $id): bool
    {
        $result = DB::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch()['cnt'] : 0;
    }

    /**
     * Delete a user from user db.
     * @param User $user
     * @return bool
     */
    public static function deleteUser(User $user): bool {
        if(self::userExists($user->getId())) {
            return DB::getPDO()->exec("
            DELETE FROM " . self::TABLE . " WHERE id = {$user->getId()}
        ");
        }
        return false;
    }

}