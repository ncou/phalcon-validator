<?php

namespace Tnt2306\Validator\Rules;

class Alpha extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $this->validator = new \Zend\I18n\Validator\Alpha();
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
