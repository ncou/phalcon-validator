<?php

namespace Tnt2306\Validator\Rules;

class Greaterthan extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $min = trim($this->getParams()[2]);
        $this->validator = new \Zend\Validator\GreaterThan(['min' => $min]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
