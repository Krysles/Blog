<?php
namespace App\Model;

class Image
{
    private $name;
    private $type;
    private $tmp_name;
    private $error;
    private $size;

    public function __construct($image) {
        $this->hydrate($image);
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    public function getName() { return $this->name; }

    public function setName($name) { $this->name = $name; }

    public function getType() { return $this->type; }

    public function setType($type) { $this->type = $type; }

    public function getTmp_name() { return $this->tmp_name; }

    public function setTmp_name($tmp_name) { $this->tmp_name = $tmp_name; }

    public function getError() { return $this->error; }

    public function setError($error) { $this->error = $error; }

    public function getSize() { return $this->size; }

    public function setSize($size) { $this->size = $size; }

}