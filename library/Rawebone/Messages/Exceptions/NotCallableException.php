<?php
namespace Rawebone\Messages\Exceptions;

/*
 * This file is part of the Message library.
 * 
 * (c) Nick Rawe <rawebone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class NotCallableException extends \Exception
{
    protected $actionName;
    
    public function __construct($actionName)
    {
        $msg = sprintf(
                "The action '%s' was asked to register a non-callable callback",
                $actionName
        );
        
        $this->actionName = $actionName;
        parent::__construct($msg);
    }
    
    public function getActionName()
    {
        return $this->actionName;
    }
}

