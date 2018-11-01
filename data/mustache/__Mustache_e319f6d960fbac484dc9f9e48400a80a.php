<?php

class __Mustache_e319f6d960fbac484dc9f9e48400a80a extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<!DOCTYPE html>
';
        $buffer .= $indent . '<?php $id=25; ?>
';
        $buffer .= $indent . '<html>
';
        $buffer .= $indent . '<head>
';
        $buffer .= $indent . '    <title>mustache Test</title>
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '<h1>Musthache Test</h1>
';
        $buffer .= $indent . '
';
        // 'students' section
        $value = $context->find('students');
        $buffer .= $this->sectionD86970581c0f95e9ca2c8865ccd5bfdd($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- < ? php
';
        $buffer .= $indent . '<!--    $m = new Mustache_Engine;-->
';
        $buffer .= $indent . '<!--    echo $m->render(\'<h1>Hello ';
        $value = $this->resolveValue($context->find('planet'), $context);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '</h1>\', array(\'planet\' => \'World!\'));-->
';
        $buffer .= $indent . '<!---->
';
        $buffer .= $indent . '<!--$id =$this->id;-->
';
        $buffer .= $indent . '<!--# initializing Mustache-->
';
        $buffer .= $indent . '<!--//require_once __dir__.\'/mustache.php-master/src/Mustache/Autoloader.php\';-->
';
        $buffer .= $indent . '<!--//Mustache_Autoloader::register();-->
';
        $buffer .= $indent . '<!--//$mustache = new Mustache_Engine;-->
';
        $buffer .= $indent . '<!--# setting data for our template-->
';
        $buffer .= $indent . '<!--$profile_data = array(-->
';
        $buffer .= $indent . '<!--\'name\' => \'Pranav Rana\',-->
';
        $buffer .= $indent . '<!--    \'age_in_years\' => $id,-->
';
        $buffer .= $indent . '<!--    \'marital_status\' => \'single\'-->
';
        $buffer .= $indent . '<!--);-->
';
        $buffer .= $indent . '<!--# preparing and outputting-->
';
        $buffer .= $indent . '<!--echo $m->render("Hi, I am ';
        $value = $this->resolveValue($context->find('name'), $context);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '. I am ';
        $value = $this->resolveValue($context->find('age_in_years'), $context);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= ' years old and ';
        $value = $this->resolveValue($context->find('marital_status'), $context);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '.",-->
';
        $buffer .= $indent . '<!--    $profile_data); # outputs: Hi, I am Pranav Rana. I am 29 years old and single.-->
';

        return $buffer;
    }

    private function sectionD86970581c0f95e9ca2c8865ccd5bfdd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<strong>{{students->address}}m</strong>
';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '<strong>';
                $value = $this->resolveValue($context->find('students->address'), $context);
                $buffer .= htmlspecialchars($value, 2, 'UTF-8');
                $buffer .= 'm</strong>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
