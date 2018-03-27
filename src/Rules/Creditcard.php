<?php

namespace Tnt2306\Validator\Rules;
use Zend\Validator\CreditCard;

class Creditcard extends BaseRule {

    public function isValid() {
        $value = trim($this->getParams()[1]);
        $card_type = trim($this->getParams()[2]);
        $this->validator = new CreditCard([$card_type]);
        return $this->validator->isValid($value);
    }

    public function getMessage() {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }

}
