<?php
/* LICENSE AGREEMENT. If folded, press za here to unfold and read license {{{ 
   vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4 foldmethod=marker:    
   +-----------------------------------------------------------------------------+
   | Copyright (c) 2004 S�rgio Gon�alves Carvalho                                |
   +-----------------------------------------------------------------------------+
   | This file is part of XML_RPC2.                                              |
   |                                                                             |
   | XML_RPC is free software; you can redistribute it and/or modify             |
   | it under the terms of the GNU Lesser General Public License as published by |
   | the Free Software Foundation; either version 2.1 of the License, or         |
   | (at your option) any later version.                                         |
   |                                                                             |
   | XML_RPC2 is distributed in the hope that it will be useful,         |
   | but WITHOUT ANY WARRANTY; without even the implied warranty of              |
   | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
   | GNU Lesser General Public License for more details.                         |
   |                                                                             |
   | You should have received a copy of the GNU Lesser General Public License    |
   | along with XML_RPC2; if not, write to the Free Software             |
   | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA                    |
   | 02111-1307 USA                                                              |
   +-----------------------------------------------------------------------------+
   | Author: S�rgio Carvalho <sergio.carvalho@portugalmail.com>                  |
   +-----------------------------------------------------------------------------+
}}} */      
/**
 * @package XML_RPC2
 */
/**
 */
/* dependencies {{{ */
require_once 'XML/RPC2/Exception.php';
require_once 'XML/RPC2/Backend/Php/Value.php';
/* }}} */
/**
 * XML_RPC array value class. Represents values of type array
 * 
 * @author S�rgio Carvalho
 * @package XML_RPC2
 */
class XML_RPC2_Backend_Php_Value_Array extends XML_RPC2_Backend_Php_Value
{
    /* Fields {{{ */
    /** The native value of this scalar instance */
    /* setNativeValue {{{ */
    /**
     * nativeValue property setter
     *
     * @param mixed value The new nativeValue
     */
    protected function setNativeValue($value) 
    {
        if (!is_array($value)) {
            throw new XML_RPC2_InvalidTypeException(sprintf('Cannot create XML_RPC2_Value_Array from type \'%s\'.', gettype($nativeValue)));
        }
        $this->_nativeValue = $value;
    }
    /* }}} */
    /* getNativeValue {{{ */
    /**
     * nativeValue property getter
     *
     * @return mixed The current nativeValue
     */
    public function getNativeValue() 
    {
        return $this->_nativeValue;
    }
    /* }}} */
    protected $_nativeValue = null;
    /* }}} */
    /* Constructor {{{ */
    /**
     * Constructor. Will build a new XML_RPC2_Backend_Php_Value_Array with the given nativeValue
     *
     * @param mixed nativeValue
     */
    public function __construct($nativeValue) 
    {
        $this->setNativeValue($nativeValue);
    }
    /* }}} */
    /* createFromDecode {{{ */
    /**
     * Decode an encoded value and build the applicable XML_RPC2_Value subclass
     * 
     * @param string The encoded XML-RPC value,
     */
    public static function createFromDecode($encodedString) 
    {
    }
    /* }}} */
    /* encode {{{ */
    /**
     * Encode the instance into XML, for transport
     * 
     * @return string The encoded XML-RPC value,
     */
    public function encode() 
    {
        $result = '<array><data>';
        foreach($this->getNativeValue() as $element) {
            $result .= '<value>';
            $result .= ($element instanceof XML_RPC2_Backend_Php_Value) ? 
                        $element->encode() : 
                        XML_RPC2_Backend_Php_Value::createFromNative($element)->encode();
            $result .= '</value>';
        }
        $result .= '</data></array>';
        return $result;
    }
    /* }}} */
    /* decode {{{ */
    /**
     * decode. Decode transport XML and set the instance value accordingly
     *
     * @param mixed The encoded XML-RPC value,
     */
    public static function decode($xml) 
    {
        // TODO Remove reparsing of XML fragment, when SimpleXML proves more solid. Currently it segfaults when
        // xpath is used both in an element and in one of its children
        $xml = simplexml_load_string($xml->asXML());
        $values = $xml->xpath('/value/array/data/value');
        $result = array();
        foreach (array_keys($values) as $i) {
            $result[] = XML_RPC2_Backend_Php_Value::createFromDecode($values[$i])->getNativeValue();
        }
        return $result;
    }
    /* }}} */
}
?>
