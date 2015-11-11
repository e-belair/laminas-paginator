<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Paginator\Adapter\Service;

use Interop\Container\ContainerInterface;
use Zend\Paginator\Adapter\Callback;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Create and return an instance of the Callback adapter.
 */
class CallbackFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Callback
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = is_array($options) ? $options : [];
        if (count($options) < 2) {
            throw new ServiceNotCreatedException(sprintf(
                '%s requires that at least two options, an Items and Count callback, be provided; received %d options',
                __CLASS__,
                count($options)
            ));
        }
        $itemsCallback = array_shift($options);
        $countCallback = array_shift($options);
        return new Callback($itemsCallback, $countCallback);
    }
}
