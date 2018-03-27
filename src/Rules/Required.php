<?php

namespace Tnt2306\Validator\Rules;
use Zend\Validator\NotEmpty;

class Required extends BaseRule
{

    public function isValid()
    {
        $value = trim($this->getParams()[1]);
        
        $this->validator = new NotEmpty();
        return $this->validator->isValid($value);

        //return (bool) $value || $value == '0' || !empty($_FILES) && isset($_FILES[$this->getParams()[0]]) && $_FILES[$this->getParams()[0]]['name'];
    }

    public function getMessage()
    {
        foreach ($this->validator->getMessages() as $value) {
            return $value;
        }
        return '';
    }
}
