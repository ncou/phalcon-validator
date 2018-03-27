<?php

namespace Tnt2306\Validator\Rules;

use Zend\Validator\EmailAddress,
    Zend\Validator\Hostname;

class Email extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);

        $this->validator = new EmailAddress(['allow' => Hostname::ALLOW_DNS, 'useMxCheck' => true, 'useDeepMxCheck' => true]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
