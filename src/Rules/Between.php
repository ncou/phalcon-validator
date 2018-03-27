<?php

namespace Tnt2306\Validator\Rules;

class Between extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $exp = explode('-', trim($this->getParams()[2]));
        $this->validator = new \Zend\Validator\Between(['min' => $exp[0], 'max' => $exp[1]]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
