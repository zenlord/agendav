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

use AgenDAV\CalDAV\Resource\Calendar;

/**
 * Represents a calendar object (with iCalendar contents) that is placed
 * on a calendar collection
 */
class CalendarObject
{
    /**
     * Some property names required from outside
     */
    const DATA = '{urn:ietf:params:xml:ns:caldav}calendar-data';
    const ETAG = '{DAV:}getetag';

    /**
     * iCalendar contents
     *
     * @var string
     */
    protected $contents;

    /**
     * URL of this object
     *
     * @var string
     */
    protected $url;

    /**
     * Calendar this object is stored at
     *
     * @var AgenDAV\CalDAV\Resource\Calendar
     */
    protected $calendar;

    /**
     * Object Etag
     *
     * @var string
     */
    protected $etag;


    /**
     * @param string $url
     * @param string $contents
     */
    public function __construct($url, $contents = null)
    {
        $this->url = $url;
        $this->contents = $contents;
    }

    /*
     * Getter for contents
     *
     * @return string
     */
    public function getContents()
    {
        return $this->contents;
    }

    /*
     * Setter for contents
     *
     * @param string $contents
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }

    /*
     * Getter for url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /*
     * Setter for url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /*
     * Getter for calendar
     *
     * @return AgenDAV\CalDAV\Resource\Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /*
     * Setter for calendar
     *
     * @param AgenDAV\CalDAV\Resource\Calendar $calendar
     */
    public function setCalendar(Calendar $calendar)
    {
        $this->calendar = $calendar;
        return $this;
    }

    /*
     * Getter for etag
     *
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /*
     * Setter for etag
     *
     * @param string $etag
     */
    public function setEtag($etag)
    {
        $this->etag = $etag;
        return $this;
    }
}
