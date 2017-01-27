<?php


namespace Payone\Request;


class CaptureModes
{
    //Mandatory for payment type BSV, KLV, KLS
    /** Set with last capture; i.e.: Delivery completed.*/
    const COMPLETED = 'completed';
    /** Set with partial deliveries (last delivery with "completed") */
    const NOTCOMPLETED = 'notcompleted';
}