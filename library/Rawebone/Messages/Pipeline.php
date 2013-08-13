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
 * This class handles the registration of Filters and their running against
 * a provided message.
 */
class Pipeline
{
    /**
     * @var \Rawebone\Messages\Filter
     */
    protected $filters = array();
    
    public function add(Filter $filter)
    {
        $this->filters[] = $filter;
    }
    
    public function run(Message $msg)
    {
        foreach ($this->filters as $filter) {
            $filter->run($msg);
        }
    }
}
