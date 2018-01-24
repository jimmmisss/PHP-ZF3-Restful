<?php
namespace User\Service;

use Zend\Http\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ProcessJson
{

    private $data;
    private $ignore;
    private $response;

    public function __construct($ignore, $data)
    {
        $this->response = new Response();
        $this->data = $data;
        $this->ignore = $ignore;
    }

    public function process(){


        $normalizer = new ObjectNormalizer();
        $normalizer->setIgnoredAttributes($this->ignore);

        $serializer = new Serializer([$normalizer],[new JsonEncoder()]);

        $content = $serializer->serialize($this->data, 'json');

        $this->response->setContent($content);

        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('Content-type','application/json');
        $this->response->setHeaders($headers);

        return $this->response;
    }

}