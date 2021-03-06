<?php 

namespace AgenDAV\CalDAV\Resource;

/*
 * Copyright 2014 Jorge López Pérez <jorge@adobo.org>
 *
 *  This file is part of AgenDAV.
 *
 *  AgenDAV is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  AgenDAV is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with AgenDAV.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Stores information about a calendar collection
 */
class Calendar
{
    /**
     * URL of this calendar
     *
     * @var string
     */
    protected $url;

    /**
     * Calendar properties
     *
     * @var array
     */
    protected $data;

    /**
     * Property names including namespaces
     */
    const DISPLAYNAME = '{DAV:}displayname';
    const CTAG = '{http://calendarserver.org/ns/}getctag';
    const COLOR = '{http://apple.com/ns/ical/}calendar-color';
    const ORDER = '{http://apple.com/ns/ical/}calendar-order';

    /**
     * Read only properties that CalDAV servers will refuse to store
     */
    public static $readonly_properties = [
        '{DAV:}:owner',
        '{DAV:}:principal-collection-set',
        '{http://calendarserver.org/ns/}getctag',
        '{urn:ietf:params:xml:ns:caldav}:calendar-user-address-set',
        '{urn:ietf:params:xml:ns:caldav}:schedule-inbox-URL',
        '{urn:ietf:params:xml:ns:caldav}:schedule-outbox-URL',
        '{DAV:}:getetag',
        '{DAV:}:getcontentlength',
        '{DAV:}:getcontenttype',
        '{DAV:}:getlastmodified',
        '{DAV:}:creationdate',
        '{DAV:}:lockdiscovery',
        '{DAV:}:supportedlock',
    ];

    /**
     * Creates a new calendar
     *
     * @param string $url   Calendar URL
     * @param array $properties More properties for this calendar
     */
    public function __construct($url, $properties = [])
    {
        $this->url = $url;
        $this->data = [];
        foreach ($properties as $property => $value) {
            $this->setProperty($property, $value);
        }
    }

    /*
     * Getter for URL
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns a property value from this calendar
     *
     * @param string $property Property to return
     * @return mixed Stored value, or null if the property is missing
     */
    public function getProperty($property)
    {
        if (array_key_exists($property, $this->data) && !empty($this->data[$property])) {
            return $this->data[$property];
        }

        return null;
    }


    /**
     * Sets a property value for this calendar
     * 
     * @param string $property  Property name
     * @param mixed $value  Value
     */
    public function setProperty($property, $value)
    {
        // Backwards compatibility
        if ($property == 'url') {
            throw new \RuntimeException('Calendar URL cannot be changed');
        }

        $this->data[$property] = $value;
    }

    /**
     * Returns all properties set for this calendar, excluding the URL
     *
     * @return array Properties (associative array), in Clark notation
     */
    public function getAllProperties()
    {
        return $this->data;
    }

    /**
     * Returns all writable properties set for this calendar. Properties from
     * self::$readonly_properties are not returned by this method
     *
     * @return array Properties (associative array), in Clark notation
     */
    public function getWritableProperties()
    {
        return array_diff_key(
            $this->data,
            array_flip(self::$readonly_properties)
        );
    }
}
