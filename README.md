# Messages

This library is an implementation of the Message Pattern described by Steve Bate
[in this](http://eventuallyconsistent.net/2013/08/12/messaging-as-a-programming-model-part-1/)
article. The article, besides being a good read, defines a pattern for
application design to enable complex algorithms to be broken down into more
manageable and fluid form.


## Usage

Usage of the library is very straightforward:

```php
<?php


$msg = new \My\Project\Action\Message();
$msg->myAction()->add(function () {
    echo "Notification Received!\n";
});

use \Rawebone\Messages as M;

M\Action::setHandlerInstance(new M\Action());

$pipe = new M\Pipeline();
$pipe->add(new \My\Project\Action\Filter());
$pipe->add(new \My\Project\Action\DependentFilter($dependency));
$pipe->run($msg);

```

In the above example, the filters are extensions of the `Rawebone\Messages\Filter`
class and the message an extension of `Rawebone\Messages\Message`.


## Actions

Actions allow for callbacks to be registered and fire on certain events happening
during the Messages lifecycle:

```php
<?php
namespace My\Project\Action;


use Rawebone\Messages\Action;
use Rawebone\Messages\Message as BaseMessage;

class Message extends BaseMessage
{
    protected $myAction;

    public function __construct()
    {
        $this->myAction = Action::newAction("myAction");
    }

    public function myAction()
    {
        return $this->myAction;
    }
}

```


## License

MIT [License](LICENSE). Go hog wild.
