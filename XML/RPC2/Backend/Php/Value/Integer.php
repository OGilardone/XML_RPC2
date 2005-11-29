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
require_once 'XML/RPC2/Backend/Php/Value/Scalar.php';
/* }}} */
/**
 * XML_RPC integer value class. Instances of this class represent int scalars in XML_RPC
 * 
 * @author S�rgio Carvalho
 * @package XML_RPC2
 */
class XML_RPC2_Backend_Php_Value_Integer extends XML_RPC2_Backend_Php_Value_Scalar
{
    /* Constructor {{{ */
    /**
     * Constructor. Will build a new XML_RPC2_Backend_Php_Value_Integer with the given value
     *
     * @param mixed value
     */
    public function __construct($nativeValue) 
    {
        $this->setScalarType('int');
        $this->setNativeValue($nativeValue);
    }
    /* }}} */
    /* decode {{{ */
    /**
     * decode. Decode transport XML and set the instance value accordingly
     *
     * @param mixed The decoded XML-RPC value,
     */
    public static function decode($xml) 
    {
        // TODO Remove reparsing of XML fragment, when SimpleXML proves more solid. Currently it segfaults when
        // xpath is used both in an element and in one of its children
        $xml = simplexml_load_string($xml->asXML());
        $value = $xml->xpath('/value/int/text()|/value/i4/text()');

        return (int) $value[0];
    }
    /* }}} */
}
?>
