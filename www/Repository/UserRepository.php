<?php


namespace App\Repository;


use App\Core\SQLConnect;
use App\Models\Users;

final class UserRepository
{
    private $dbConnect;

    public function __construct(SQLConnect $SQLConnect)
    {
        $this->dbConnect = $SQLConnect->connect();
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->getOneBy(["id" => $id], true);
    }
    /**
     * @param array $where the where clause
     * @param bool $object if it will return an array of results ou an object
     * @return mixed
     */
    public function getOneBy(array $where, bool $object = false)
    {
        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . "=:" . $key;
        }
        $sql = " SELECT * FROM Users WHERE  " . implode(" AND ", $sqlWhere) . ";";
        $query = $this->dbConnect->prepare($sql);

        if ($object) {
            $this->getOneObject($query, $where);
        } else {
            $this->getOneArray($query, $where);
        }
    }

    public function getOneArray(\PDOStatement $query, array $where): array
    {
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);
        return $query->fetch();
    }

    public function getOneObject(\PDOStatement $query, array $where): object
    {
        $query->setFetchMode(PDO::FETCH_INTO, $this);
        $query->execute($where);
        return $query->fetch();
    }

    public function save(Users $users): void
    {
        $dataObject = get_object_vars($users);
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));
        if (is_null($dataChild["id"])) {
            $sql = "INSERT INTO Users ( " .
                implode(",", array_keys($dataChild)) . ") VALUES ( :" .
                implode(",:", array_keys($dataChild)) . ")";
            $query = $this->dbConnect->prepare($sql);
            $query->execute($dataChild);
        } else {
            $sqlUpdate = [];
            foreach ($dataChild as $key => $value) {
                if ($key != "id") {
                    $sqlUpdate[] = $key . "=:" . $key;
                }
            }
            $sql = "UPDATE Users SET " . implode(",", $sqlUpdate) . " WHERE id=:id";
            $query = $this->dbConnect->prepare($sql);
            $query->execute($dataChild);
        }
    }
}