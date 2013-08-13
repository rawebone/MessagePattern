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

class FilterNotImplementedException extends \Exception
{
    protected $filterName;
    
    public function __construct($filterName)
    {
        $msg = sprintf(
                "The filter identified by '%s' has not been full implemented",
                $filterName
        );
        
        $this->filterName = $filterName;
        parent::__construct($msg);
    }
    
    public function getFilterName()
    {
        return $this->filterName;
    }
}

