<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */
namespace Zend\Stdlib\Hydrator\Filter;

/**
 * @category   Zend
 * @package    Zend_Stdlib
 * @subpackage Hydrator
 */
class MethodMatchFilter implements FilterInterface
{
    /**
     * The method to exclude
     * @var string
     */
    protected $method = null;

    /**
     * Either an exclude or an include
     * @var bool
     */
    protected $exclude = null;

    /**
     * @param string $method The method to exclude
     */
    public function __construct($method, $exclude = true)
    {
        $this->method = $method;
        $this->exclude = $exclude;
    }

    public function filter($property)
    {
        $pos = strpos($property, '::');
        if ($pos !== false) {
            $pos += 2;
        } else {
            $pos = 0;
        }
        if (substr($property, $pos) === $this->method) {
            return $this->exclude ? false : true;
        }
        return $this->exclude ? true : false;
    }
}