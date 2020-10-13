<?php
return array(
    'php.curl'      => array(
        'name'          => 'cURL' ,
        'description'   => _wp('Exchange data with external servers'),
        'strict'        => true
    ),
    
    'php.xmlreader'     => array(
        'name'          => 'XMLReader',
        'description'   => _wp('XML parser'),
        'strict'        => true
    ),
    
    'php.simplexml'     => array(
        'name'          => 'SimpleXML',
        'description'   => _wp('Toolset to convert XML to an object'),
        'strict'        => true
    ),
    
    'php'               => array(
        'strict'        => true,
        'version'       => '>=5.4'
    )
);
