<?php

namespace Tnt2306\Validator\Rules;

class Phonevn extends BaseRule {

    public function isValid() {
        $phone = trim($this->getParams()[1]);
        if ($this->detect_number($phone) === FALSE) {
            return false;
        }
        return true;
    }

    public function getMessage() {
        return 'Phone is invalid';
    }

    public function start_with($needle, $haystack) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function detect_number($number) {
        $carriers_number = [
            '096' => 'Viettel',
            '097' => 'Viettel',
            '098' => 'Viettel',
            '0162' => 'Viettel',
            '0163' => 'Viettel',
            '0164' => 'Viettel',
            '0165' => 'Viettel',
            '0166' => 'Viettel',
            '0167' => 'Viettel',
            '0168' => 'Viettel',
            '0169' => 'Viettel',
            '090' => 'Mobifone',
            '093' => 'Mobifone',
            '0120' => 'Mobifone',
            '0121' => 'Mobifone',
            '0122' => 'Mobifone',
            '0126' => 'Mobifone',
            '0128' => 'Mobifone',
            '091' => 'Vinaphone',
            '094' => 'Vinaphone',
            '0123' => 'Vinaphone',
            '0124' => 'Vinaphone',
            '0125' => 'Vinaphone',
            '0127' => 'Vinaphone',
            '0129' => 'Vinaphone',
            '0993' => 'Gmobile',
            '0994' => 'Gmobile',
            '0995' => 'Gmobile',
            '0996' => 'Gmobile',
            '0997' => 'Gmobile',
            '0199' => 'Gmobile',
            '092' => 'Vietnamobile',
            '0186' => 'Vietnamobile',
            '0188' => 'Vietnamobile',
            '095' => 'SFone'
        ];

        $number = str_replace(array('-', '.', ' '), '', $number);
        if (!preg_match('/^(01[2689]|09)[0-9]{8}$/', $number)){
            return false;
        }
        $start_numbers = array_keys($carriers_number);
        foreach ($start_numbers as $start_number) {
            if ($this->start_with($start_number, $number)) {
                return $carriers_number[$start_number];
            }
        }
        return false;
    }

}
