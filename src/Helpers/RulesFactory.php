<?php

namespace Tnt2306\Validator\Helpers;

class RulesFactory
{

    public static function createRule($ruleName, $config, $params)
    {
        $ruleName = ucfirst($ruleName);
       
        if (!file_exists(__DIR__.'/../Rules/'.$ruleName.'.php')) {
            trigger_error('Such rule doesn\'t exists: '.$ruleName, E_USER_ERROR);
        }
      
        $class = 'Tnt2306\\Validator\\Rules\\'.$ruleName;
        
        $ruleInstance = new $class($config);
        
        $ruleInstance->setParams($params);
        return $ruleInstance;
    }
}
