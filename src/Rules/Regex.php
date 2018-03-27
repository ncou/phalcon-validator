<?php

namespace Tnt2306\Validator\Rules;


class Creditcard extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $pattern = trim($this->getParams()[2]);
        $this->validator = new \Zend\Validator\Regex(['pattern' => $pattern]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
