<?php

namespace Tnt2306\Validator\Rules;

use Zend\Validator\StringLength;

class Max extends BaseRule {

    public function isValid() {
        $input = trim($this->getParams()[1]);
        $value = trim($this->getParams()[2]);

        $this->validator = new StringLength(['max' => $value]);
        $this->validator->setEncoding("UTF-8");
        return $this->validator->isValid($input);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
