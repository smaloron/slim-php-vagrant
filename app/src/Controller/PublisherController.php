<?php


namespace M2i\monProjet\Controller;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PublisherController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * PublisherController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function showOne(RequestInterface $request, ResponseInterface $response, $args){
        $data = $this->container->get("dao.publisher")->findOneById($args["id"]);
        $newResponse = $response->withHeader("content-type", "application/json");
        $newResponse->getBody()->write(json_encode($data));

        return $newResponse;
    }

    public function showAll(RequestInterface $request, ResponseInterface $response, array $args){
        $data = $this->container->get("dao.publisher")->findAll();
        $newResponse = $response->withHeader("content-type", "application/json");
        $newResponse->getBody()->write(json_encode($data));
        return $newResponse;
    }

    public function deleteOne(RequestInterface $request, ResponseInterface $response, array $args){
        $newResponse = $response->withHeader("content-type", "application/json");

        try{
            if($this->container->get("dao.publisher")->deleteOneById($args["id"])){
                $result = ["success" => true];
            } else {
                $result = ["success" => false];
            }
        } catch (\PDOException $ex){
            $result = ["success" => false, "message" => $ex->getMessage()];
        }


        $newResponse->getBody()->write(json_encode($result));
        return $newResponse;
    }





}