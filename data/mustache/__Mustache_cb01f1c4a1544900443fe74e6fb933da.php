<?php

class __Mustache_cb01f1c4a1544900443fe74e6fb933da extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<h1><?php echo $this->translate(\'An error occurred\') ?></h1>
';
        $buffer .= $indent . '<h2><?php echo $this->message ?></h2>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<?php if (isset($this->display_exceptions) && $this->display_exceptions): ?>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<?php if(isset($this->exception) && $this->exception instanceof Exception): ?>
';
        $buffer .= $indent . '<hr/>
';
        $buffer .= $indent . '<h2><?php echo $this->translate(\'Additional information\') ?>:</h2>
';
        $buffer .= $indent . '<h3><?php echo get_class($this->exception); ?></h3>
';
        $buffer .= $indent . '<dl>
';
        $buffer .= $indent . '    <dt><?php echo $this->translate(\'File\') ?>:</dt>
';
        $buffer .= $indent . '    <dd>
';
        $buffer .= $indent . '        <pre class="prettyprint linenums"><?php echo $this->exception->getFile() ?>:<?php echo $this->exception->getLine() ?></pre>
';
        $buffer .= $indent . '    </dd>
';
        $buffer .= $indent . '    <dt><?php echo $this->translate(\'Message\') ?>:</dt>
';
        $buffer .= $indent . '    <dd>
';
        $buffer .= $indent . '        <pre class="prettyprint linenums"><?php echo $this->escapeHtml($this->exception->getMessage()) ?></pre>
';
        $buffer .= $indent . '    </dd>
';
        $buffer .= $indent . '    <dt><?php echo $this->translate(\'Stack trace\') ?>:</dt>
';
        $buffer .= $indent . '    <dd>
';
        $buffer .= $indent . '        <pre class="prettyprint linenums"><?php echo $this->escapeHtml($this->exception->getTraceAsString()) ?></pre>
';
        $buffer .= $indent . '    </dd>
';
        $buffer .= $indent . '</dl>
';
        $buffer .= $indent . '<?php
';
        $buffer .= $indent . '    $e = $this->exception->getPrevious();
';
        $buffer .= $indent . '    if ($e) :
';
        $buffer .= $indent . '?>
';
        $buffer .= $indent . '<hr/>
';
        $buffer .= $indent . '<h2><?php echo $this->translate(\'Previous exceptions\') ?>:</h2>
';
        $buffer .= $indent . '<ul class="unstyled">
';
        $buffer .= $indent . '    <?php while($e) : ?>
';
        $buffer .= $indent . '    <li>
';
        $buffer .= $indent . '        <h3><?php echo get_class($e); ?></h3>
';
        $buffer .= $indent . '        <dl>
';
        $buffer .= $indent . '            <dt><?php echo $this->translate(\'File\') ?>:</dt>
';
        $buffer .= $indent . '            <dd>
';
        $buffer .= $indent . '                <pre class="prettyprint linenums"><?php echo $e->getFile() ?>:<?php echo $e->getLine() ?></pre>
';
        $buffer .= $indent . '            </dd>
';
        $buffer .= $indent . '            <dt><?php echo $this->translate(\'Message\') ?>:</dt>
';
        $buffer .= $indent . '            <dd>
';
        $buffer .= $indent . '                <pre class="prettyprint linenums"><?php echo $this->escapeHtml($e->getMessage()) ?></pre>
';
        $buffer .= $indent . '            </dd>
';
        $buffer .= $indent . '            <dt><?php echo $this->translate(\'Stack trace\') ?>:</dt>
';
        $buffer .= $indent . '            <dd>
';
        $buffer .= $indent . '                <pre class="prettyprint linenums"><?php echo $this->escapeHtml($e->getTraceAsString()) ?></pre>
';
        $buffer .= $indent . '            </dd>
';
        $buffer .= $indent . '        </dl>
';
        $buffer .= $indent . '    </li>
';
        $buffer .= $indent . '    <?php
';
        $buffer .= $indent . '        $e = $e->getPrevious();
';
        $buffer .= $indent . '        endwhile;
';
        $buffer .= $indent . '    ?>
';
        $buffer .= $indent . '</ul>
';
        $buffer .= $indent . '<?php endif; ?>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<?php else: ?>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<h3><?php echo $this->translate(\'No Exception available\') ?></h3>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<?php endif ?>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<?php endif ?>
';

        return $buffer;
    }
}
