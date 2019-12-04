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
        $statement = $this->pdo->prepare("SELECT * FROM publishers WHERE id=?");
        $statement->execute([$id]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }


}