<?php

namespace Tnt2306\Validator\Rules;

use Zend\Validator\Uri;

class Url extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $this->validator = new Uri(['allowRelative' => FALSE, 'allowAbsolute' => TRUE]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
