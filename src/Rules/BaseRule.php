<?php

namespace Tnt2306\Validator\Rules;

abstract class BaseRule {

    private $params;
    private $validator;

    public function setParams($params) {
        $this->params = $params;
        return $this;
    }

    public function getParams() {
        return $this->params;
    }

    public function getRuleName() {

        $classPath = explode('\\', get_class($this));
        return array_pop($classPath);
    }

    abstract public function getMessage();

    abstract public function isValid();
}
