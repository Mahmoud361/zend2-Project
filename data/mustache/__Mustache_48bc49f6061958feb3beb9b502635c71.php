<?php

class __Mustache_48bc49f6061958feb3beb9b502635c71 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
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
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>
';
        $buffer .= $indent . '<h1>Hello';
        $value = $this->resolveValue($context->find('id'), $context);
        $buffer .= htmlspecialchars($value, 2, 'UTF-8');
        $buffer .= '</h1>
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
}
