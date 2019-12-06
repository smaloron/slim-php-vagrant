<?php

namespace M2i\monProjet\Model;

class PublisherDAO
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * PublisherDAO constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findOneById($id){
        $statement = $this->pdo->prepare("SELECT * FROM editeurs WHERE id=?");
        $statement->execute([$id]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll(){
        $sql = "SELECT * FROM editeurs";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteOneById($id){
        $sql = "DELETE FROM editeurs WHERE id= ?";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([$id]);
    }


}