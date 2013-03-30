<?php

	// Load the XML source
	$xml = new DOMDocument("1.0", 'UTF-8');
	$xml->load('api.xml');
	
	$xsl = new DOMDocument("1.0", 'UTF-8');
	$xsl->load('assets/docTemplate.xsl');
	
	// Configure the transformer
	$proc = new XSLTProcessor();
	$proc->importStyleSheet($xsl); // attach the xsl rules
	
	$result = $proc->transformToDoc($xml);
	//header("Content-Type: text/xml");
	echo utf8_encode($result->saveXML());
?>