<?php
namespace Rawebone\Messages;

/*
 * This file is part of the Message library.
 * 
 * (c) Nick Rawe <rawebone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * An Action sends notifications out to listeners and should be registered to
 * a property of a Message.
 */
class Action
{
    protected $name = "";
    protected $canFireManyTimes = false;
    protected $fired = false;
    protected $callbacks = array();
    protected static $handlerReflection;
    
    public function __construct($name, $canFireManyTimes = false)
    {
        $this->name = $name;
        $this->canFireManyTimes = $canFireManyTimes;
    }
    
    public function add($callable)
    {
        if (!is_callable($callable)) {
            throw new Exceptions\NotCallableException($this->name);
        }
        
        $this->callbacks[] = $callable;
    }
    
    public function run(array $args = array())
    {
        if ($this->fired && !$this->canFireManyTimes) {
            throw new Exceptions\ActionFiredAgainException($this->name);
        }
        
        $this->fired = true;
        
        foreach ($this->callbacks as $callable) {
            call_user_func_array($callable, $args);
        }
    }
    
    public static function setHandlerInstance(Action $handler)
    {
        self::$handlerReflection = new \ReflectionClass($handler);
    }
    
    public static function newAction($name, $canFireManyTimes = false)
    {
        return self::$handlerReflection->newInstance($name, $canFireManyTimes);
    }
}
