<?php

/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Core\Collections\Collection;

/**
 * Description of FWAColections
 *
 * @author artphotografie
 */
use ArrayIterator;
use Closure;

class Ap_IteratorCollection implements \ArrayAccess {

    /**
     * @var array
     */
    private $elements;
    private $position = 0;

    //put your code here
    public function __construct(array $elements) {

        $this->elements = $elements;
    }

    public function toArray() {
        return $this->elements;
    }

    public function getIterator() {

        return new \ArrayObject($this->elements);
    }

    public function count() {
        return count($this->elements);
    }

    public function current() {
        return current($this->elements);
    }

    public function contains($element) {
        return in_array($element, $this->elements, true);
    }

    /**
     * @return mixed
     */
    public function next() {
        return next($this->elements);
    }

    public function last() {
        return end($this->elements);
    }

    public function first() {
        return reset($this->elements);
    }

    public function key() {
        return key($this->elements);
    }

    public function valid() {
        // return isset($this->elements[$this->position]);
        return $this->offsetExists($this->elements);

    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value) {
        if (!isset($offset)) {
            return $this->set($offset, $value);
        }
        $this->set($offset, $value);
    }

    public function offsetUnset($offset) {
        return $this->remove($offset);
    }

    public function containsKey($key) {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }

    public function offsetExists($offset) {
        return $this->containsKey($offset);
    }

    public function remove($key) {
        if (!isset($this->elements[$key]) && !array_key_exists($key, $this->elements)) {
            return null;
        } else {
            $removed = $this->elements[$key];
            unset($this->elements[$key]);

            return $removed;
        }
    }

    public function removeEleme($element) {
        $key = array_search($element, $this->elements, true);
        if ($key == false) {
            return false;
        }
        unset($this->elements[$key]);
        return true;
    }

    public function add($value) {
        $this->elements[] = $value;

        return $this;
    }

    public function set($key, $value) {
        $this->elements[$key] = $value;

        return true;
    }

    public function ksort() {

        return ksort($this->elements);
    }

    public function natSort() {
        return natsort($this->elements);
    }

    public function natcasesort() {
        return natcasesort($this->elements);
    }

    public function exists(Closure $p) {
        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                return true;
            }
        }
        return false;
    }

    public function indexOf($element) {
        return array_search($element, $this->elements, true);
    }

    public function isEmpty() {
        return empty($this->elements);
    }

    public function getValues() {

        return array_values($this->elements);
    }

    public function getKey() {
        return array_keys($this->elements);
    }

    public function get($key) {
        return isset($this->elements[$key]) ? $this->elements[$key] : null;
    }

}
