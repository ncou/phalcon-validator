# phalcon-validator
Make your apps validation easily (inspired by Zend Validation)

# Installation
Create the `composer.json` file as follows:
```json
{
    "require": {
        "tnt2306/phalcon-validator": "dev-master" 
    }
}
```

# Quick start :rocket:
```php
<?php

$rules = [
    # firstname and lastname must exists
    # they should be alphanumeric
    # atleast 2 characters
    'firstname, lastname' => 'required|alpha|min:2',

    # max until 18 characters only
    'lastname'            => 'max:18',

    # must be an email format
    # must be unique under 'users' table
    'email'               => 'email|unique:users',

    # must be numeric
    # must exists under 'users' table
    'id'                  => 'numeric|exists:users',
    'age'                 => 'min:16|numeric',

    # roll[0] or roll[1] values must be in the middle 1 to 100
    'roll[0], roll[1]'    => 'numeric|between:1, 100',

    # the format must be 'm-Y.d H:i'
    'date'                => 'dateFormat:(m-Y.d H:i)',

    # it must be an image format under $_FILES global variable
    'profileImg'          => 'image',

    # the provided phone number should follow the format
    # correct: +38(123)456-12-34
    # wrong: +38(123)56-123-56
    # wrong: +39(123)456-12-34
    'phoneMask'           => 'phoneMask:(+38(###)###-##-##)',
    'randNum'             => 'between:1, 10|numeric',

    # the value must be an IP Format
    'ip'                  => 'ip',
    'password'            => 'required|min:6',

    # the value from a key 'password' must be equal to 'password_repeat' value
    'password_repeat'     => 'same:password',

    # it must be a json format
    'json'                => 'json',
    'site'                => 'url',

    # cash10 or cash25 must only have these
    # 1 or 2 or 5 or 10 or 20 or 50
    'cash10, cash25'      => 'in:1, 2, 5, 10, 20, 50',

    # the value must not have 13 or 18 or 3 or 4
    'elevatorFloor'       => 'notIn:13, 18, 3, 4',
];

$customMessage = [
   'email.required'      => 'Field :field: is required',
   'email.email'         => 'Email has bad format',
   'email.unique'        => 'This email :value: is not unique',
   'elevatorFloor.notIn' => 'Oops',
];

use Tnt2306\Validator\Validator as PhalconValidator;
$v = PhalconValidator::make($_POST, $rules, $customMessage);

# for specific field
# you can use below code.
$v->lastname->passes();
$v->lastname->fails();

# if you're required to check everything
# and there must no failing validation
$v->passes();
$v->fails();

# get first error message
$v->first();

# get first error for `firstname`
$v->first('lastname');
$v->firstname->first();

# return first error message from each field
$v->firsts();

# get all messages (with param for concrete field)
$v->messages();
$v->messages('password');

# get all `password` messages
$v->password->messages();

# get 2d array with fields and messages
$v->raw();

# to append a message
$v->add('someField', 'Something is wrong with this');
```

Chuyên kinh doanh sản xuất cửa lưới chống muỗi giá rẻ và [cua luoi chong muoi](https://cualuoichongmuoi.xyz) nhập khẩu, các loại cửa lưới ngăn muỗi tại công ty việt thống đều được bảo hành chính hãng 3 năm

## License

Phalcon Validator is open-sourced software licensed under the [GNU GPL](LICENSE).
© 2018 Nguyen Tran Trung and <a href="https://github.com/tnt2306/phalcon-validator/graphs/contributors">all the contributors</a>.
