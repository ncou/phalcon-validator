<?php

namespace Tnt2306\Validator;

use Tnt2306\Validator\Helpers\ValidatorFacade;
use Tnt2306\Validator\Helpers\RulesFactory;

final class Validator {

    private static $validatorFacade = null;
    
    public static function make(array $data, array $rules, array $userMessages = []) {
        self::$validatorFacade = new ValidatorFacade($userMessages);

        $data = self::prepareData($data);
        $rules = self::prepareRules($rules);
        
        foreach ($rules as $fieldName => $fieldRules) {
            $fieldName = trim($fieldName);
            $fieldRules = trim($fieldRules);

            if (!$fieldRules) {
                //no rules
                continue;
            }

            $groupedRules = explode('|', $fieldRules);

            foreach ($groupedRules as $concreteRule) {
                $ruleNameParam = explode(':', $concreteRule);
                $ruleName = $ruleNameParam[0];

                //for date/time validators
                if (count($ruleNameParam) >= 2) {
                    $ruleValue = implode(':', array_slice($ruleNameParam, 1));

                    //for other params
                } else {
                    $ruleValue = isset($ruleNameParam[1]) ? $ruleNameParam[1] : '';
                }

                $ruleInstance = RulesFactory::createRule($ruleName, [
                    $fieldName,                                        // The field name
                    isset($data[$fieldName]) ? $data[$fieldName] : '', // The provided value
                    $ruleValue,                                        // The rule's value
                ]);
            
                if (!$ruleInstance->isValid()) {
                    self::$validatorFacade->chooseErrorMessage($ruleInstance);
                }
            }
        }
        return self::$validatorFacade;
    }

    private static function prepareData(array $data) {
        $newData = [];

        foreach ($data as $paramName => $paramValue) {
            if (is_array($paramValue)) {
                foreach ($paramValue as $newKey => $newValue) {
                    $newData[trim($paramName) . '[' . trim($newKey) . ']'] = trim($newValue);
                }
            } else {
                $newData[trim($paramName)] = trim($paramValue);
            }
        }

        return $newData;
    }

    private static function prepareRules(array $rules) {
        $mergedRules = [];

        foreach ($rules as $ruleFields => $ruleConditions) {

            //if set of fields like 'firstname, lastname...'
            if (strpos($ruleFields, ',') !== false) {
                foreach (explode(',', $ruleFields) as $fieldName) {
                    $fieldName = trim($fieldName);

                    if (!isset($mergedRules[$fieldName])) {
                        $mergedRules[$fieldName] = $ruleConditions;
                    } else {
                        $mergedRules[$fieldName] .= '|' . $ruleConditions;
                    }
                }
            } else {
                if (!isset($mergedRules[$ruleFields])) {
                    $mergedRules[$ruleFields] = $ruleConditions;
                } else {
                    $mergedRules[$ruleFields] .= '|' . $ruleConditions;
                }
            }
        }

        $finalRules = [];

        //remove duplicated rules, like 'required|alpha|required'
        foreach ($mergedRules as $newRule => $rule) {
            $finalRules[$newRule] = implode('|', array_unique(explode('|', $rule)));
        }

        return $finalRules;
    }

}
