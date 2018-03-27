<?php

namespace Tnt2306\Validator\Rules;

class Date extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $format = trim($this->getParams()[2]);
       
        $this->validator = new \Zend\Validator\Date();
        $this->validator->setFormat($format);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
