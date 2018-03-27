<?php

namespace Tnt2306\Validator\Rules;

use Zend\Validator\Digits as ZendDigits;

class Digits extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $this->validator = new ZendDigits();
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
