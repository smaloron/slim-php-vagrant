<?php


namespace M2i\monProjet\Model;


class Publisher
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Publisher
     */
    public function setName(string $name): Publisher
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Publisher
     */
    public function setId(int $id): Publisher
    {
        $this->id = $id;
        return $this;
    }



}