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
require_once 'XML/RPC2/Backend.php';
/* }}} */
/**
 * XML_RPC value abstract class. All XML_RPC value classes inherit from XML_RPC2_Value
 * 
 * @author S�rgio Carvalho
 * @package XML_RPC2
 */
abstract class XML_RPC2_Value 
{
    /* createFromNative {{{ */
    /**
     * Factory method that constructs the appropriate XML-RPC encoded type value
     *
     * @param mixed  Value to be encode
     * @param string (optional) Explicit XML-RPC type as enumerated in the XML-RPC spec (defaults to automatically selected type)
     * @return mixed The encoded value
     */
    public static function createFromNative($value, $explicitType = null)
    {
        return @call_user_func(array(XML_RPC2_Backend::getValueClassname(), 'createFromNative'), $value, $explicitType);
    }
    /* }}} */
}
?>
