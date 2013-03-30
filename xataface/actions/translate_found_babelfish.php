<?php
//error_reporting(E_STRICT);
//ini_set('display_errors', 'on');
import( 'HTML/QuickForm.php');
//import( 'babelfish.class.php');
//import('GoogleTranslate.class.php');
import( 'I18Nv2/Language.php');
class dataface_actions_translate_found_babelfish {
	var $table;
	var $translatableLanguages;
	var $languageCodes;
	var $metatag = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';

	/**
	 * The name of the table that is used to store content that is to be translated
	 * in full page translation mode.
	 */
	var $transpage_table = TRANSLATION_PAGE_TABLE; // originally defined in config.inc.php
	
	function handle($params){

		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		$this->table =& Dataface_Table::loadTable($query['-table']);
		
		
		
		$translations =& $this->table->getTranslations();
		foreach (array_keys($translations) as $trans){
			$this->table->getTranslation($trans);
		}
		//print_r($translations);
		if ( !isset($translations) || count($translations) < 2 ){
			// there are no translations to be made
			trigger_error('Attempt to translate a record in a table "'.$this->table->tablename.'" that contains no translations.', E_USER_ERROR);
		}
		
		$this->translatableLanguages = array_keys($translations);
		$translatableLanguages =& $this->translatableLanguages;
		$this->languageCodes = new I18Nv2_Language($app->_conf['lang']);
		$languageCodes =& $this->languageCodes;
		$currentLanguage = $languageCodes->getName( $app->_conf['lang']);
		
		if ( count($translatableLanguages) < 2 ){
			return PEAR::raiseError(
				df_translate('Not enough languages to translate',
							'There aren\'t enough languages available to translate.'), DATAFACE_E_ERROR);
		
		}
		
		$defaultSource = $translatableLanguages[0];
		$defaultDest = $translatableLanguages[1];
		
		$options = array();
		foreach ($translatableLanguages as $lang){
			$options[$lang] = $languageCodes->getName($lang);
		}
		
		$form = new HTML_QuickForm('TranslationForm', 'POST');
		$form->addElement('select', '-sourceLanguage', 'Source Language', $options);
		$form->addElement('select','-destinationLanguage', 'Destination Language', $options);
		$form->setDefaults( array('-sourceLanguage'=>$defaultSource, '-destinationLanguage'=>$defaultDest));
		$form->addElement('submit','-translate','Translate');
		
		$mask =& Dataface_LinkTool::getMask();
			// The mask of parameters that are passed to new urls
			// We need to modify this mask so that the appropriate parameters are passed.
		
		foreach ( $query as $key=>$value ){
			$form->addElement('hidden', $key);

			$form->setDefaults(array($key=>$value));

			
		}
		
		if ( $form->validate() ){
			
			$res = $form->process( array(&$this, 'processForm'));
			if ( PEAR::isError($res) ){
				if ( $query['--format'] == 'rest' ){
					header('Content-type: text/plain');
					echo 'FAILED'."\n".$res->getMessage();
					exit;
				}
				return $res;
				
			} else {
				//print_r($form->exportValues());
				//echo "Done";exit;
				if ( $query['--format'] == 'rest' ){
					header('Content-type: text/plain');
					echo 'SUCCEEDED'."\nRecords Successfully Translated";
					exit;
				}
				header('Location: '.$app->url('-action=list&-sourceLanguage=&-destinationLanguage=&-translate=').'&--msg=Records successfully translated');
				exit;
			}
		}
		
		ob_start();
		$form->display();
		$out = ob_get_contents();
		ob_end_clean();
		df_display(array('body'=>$out), 'Dataface_Main_Template.html');
		
		
	}
	
	/**
	 * Recursively translates the values in an array - or string.
	 */
	function translate($value, $srcLang, $destLang, &$babelfish){
		$app =& Dataface_Application::getInstance();
		
		//echo error_reporting();
		//echo "here";exit;
		$inputArray = $value;
		$value = $this->arrayToHtml($value, '__translated__');

		$webpage_key = md5($value);
		
		$value = '<html><head>'.$this->metatag.'</head><body>'.$value.'</body></html>';
		$original = $value;
		$value = $this->prepareWebpage($webpage_key, $value);
		
				
				
		//echo $value;
			
		$out = $babelfish->translate($value, $srcLang, $destLang, true);
		if ( PEAR::isError($out) ){
			// Looks like we've been blocked
			$del =& $app->getDelegate();
			if ( $del and method_exists($del, 'handleTranslationError') ){
				$out = $del->handleTranslationError($out);
				
			}
			
			if ( PEAR::isError($out) ){
				return $out;
			}
		}
		$out = '<head>'.$this->metatag.'</head>'.$out;
		//echo $out;exit;
		$out = str_replace("<p><p><p><p><p><p><p>", "\n", $out);
		
		// Now we're going to convert all of the links so that they still point
		// to their original location.
		
		if ( function_exists('tidy_parse_string') ){
			$config = array('output-encoding'=>'utf8');
			
			$original = tidy_repair_string($original, $config, "utf8");
			$out = tidy_repair_string($out, $config, "utf8");
		}
		
		
		$tmpfile = tempnam('/tmp', 'translation-'.time());
		file_put_contents($tmpfile.'-source.html', $original);
		file_put_contents($tmpfile.'-dest.html', $out);
		
		
		$srcDOM = new DOMDocument('1.0', 'utf-8');
		@$srcDOM->loadHTML($original);
		$destDOM = new DOMDocument('1.0', 'utf-8');
		@$destDOM->loadHTML($out);


		//echo "<h2>original</h2>".$original;
		//echo '<h2>New</h2>'.$out;
		
		
		$spans = $destDOM->getElementsByTagName('span');
		//echo "here";exit;
		$nodesToDelete = array();
		$nodesToBeInserted = array();
		for ($i=0; $i<$spans->length; $i++){
			$thisSpan = $spans->item($i);
			//echo "here";exit;
			if ( strval($thisSpan->getAttribute('class')) == 'google-src-text' ){
				
				$nodesToDelete[] = $thisSpan;
				
			}
			
			if ( strval($thisSpan->getAttribute('onmouseover')) == '_tipon(this)' ){
				$childNodes = $thisSpan->childNodes;
				for ($j=0; $j<$childNodes->length; $j++){
					$nodesToBeInserted[] = array($thisSpan->parentNode, $childNodes->item($j), $thisSpan);
					//$thisSpan->parentNode->insertBefore($childNodes->item($j), $thisSpan);
					
				}
				//echo 
				
				$nodesToDelete[] = $thisSpan;
				//$parent->removeChild($thisSpan);
				unset($childNodes);
				
			}
			unset($thisSpan);
		
		}
		
		foreach ($nodesToBeInserted as $ins){
			$ins[2]->removeChild($ins[1]);
			$ins[0]->insertBefore($ins[1], $ins[2]);
		}
		
		foreach ($nodesToDelete as $node){
			$node->parentNode->removeChild($node);
		}
		
		
		//echo '<h2>New</h2>'.$destDOM->saveHTML().'<h1>End</h1>';exit;
		
		$srcLinks = $srcDOM->getElementsByTagName('a');
		$destLinks = $destDOM->getElementsByTagName('a');
		//print('Old: '.$srcLinks->length);
		//print('New: '.$destLinks->length);
		//$changes = array();
		for ($i=0; $i<min($srcLinks->length,$destLinks->length); $i++ ){
			$destLink =& $destLinks->item($i);
			$srcLink =& $srcLinks->item($i);
			//echo "Found link ".$srcLink->getAttribute('href').' with dest link '.$destLink->getAttribute('href');
			$destLink->setAttribute('href', strval($srcLink->getAttribute('href')));
			//echo "Now destlink is ".$destLink->getAttribute('href');
			$changes[] = array('node' => $destLink, 'href'=>strval($srcLink->getAttribute('href')));
			unset($srcLink);
			unset($destLink);
		}
		
		//foreach ($changes as $change){
		//	$change['node']->setAttribute('href',$change['href']);
		//}
		
		$out = $destDOM->saveHTML();
		//echo $out; exit;
		//echo $out;exit;

		
		
			
			$outputArray = $this->htmlToArray($out, '__translated__');
			$this->clearWebpage($webpage_key);
				
		//	}
			//
			return $outputArray;
		//}
	}
	
	/**
	 * Converts (possibly multidimensional) array to html so that it can be passed
	 * to the google translator.
	 * @param mixed $array Either array or string to be converted.
	 * @param string $prefix The prefix for the ids of the array elements.
	 * @returns string HTMLized version of the array, using nested div tags.
	 */
	function arrayToHtml($array, $prefix){
	
		if ( is_array($array) ){
			foreach ($array as $key=>$value){
				$array[$key] = $this->arrayToHtml($value, $prefix.'/'.$key);
			}
			return '<div id="'.$prefix.'">'.implode("\n",$array).'</div>';
		} else {
		
			return '<div id="'.$prefix.'">'.str_replace("\n", "<p><p><p><p><p><p><p>", $array).'</div>';
		}
	}
	
	/**
	 * <p>Converts the HTML that was returned from Google to an array that matches
	 * the format of the array that was originally sent to google to be 
	 * translated.</p>
	 * <p>This array has the form:</p>
	 * <code>
	 *  [0]->array([field1]=>val1, [field2]=>val2, ...),
	 *  [1]->array(...)
	 *  ...
	 *  [n]->...
	 * </code>
	 *
	 * @param string $html The HTML String.
	 * @param string $prefix The prefix id of the div tags containing the data.
	 * @returns array 
	 */
	function htmlToArray($html, $prefix='__translated__'){
		$doc = new DOMDocument('1.0','UTF-8');
		@$doc->loadHTML($html);
		$doc->encoding = 'UTF-8';
		$tags = $doc->getElementsByTagName('div');
		$out = array();
		foreach ($tags as $tag) {
		
			if ( $tag->attributes and ($id = $tag->attributes->getNamedItem('id')) and strstr($id->nodeValue, $prefix) == $id->nodeValue ){
				// This div tag is one of the tags that we encoded.. it could wrap a record
				// or it could only wrap a field.
				$path = explode('/', $id->nodeValue);
				if ( count($path) == 2 ){
					// This tag wraps a record
					$out[$path[1]] = array();
				} else if ( count($path) == 3){
				
					
					$tempDoc = new DOMDocument();
					$tempDoc->encoding = 'UTF-8';
					$frag = $tempDoc->createDocumentFragment();
					$frag->appendXML($this->metatag);

					$node = $tempDoc->importNode($tag, true);
					
					$frag->appendChild($node);
					$tempDoc->appendChild($frag);
					$tempOut = $tempDoc->saveHTML();
					if ( preg_match('/<div id="'.preg_quote($id->nodeValue,'/').'">(.*)<\/div>/s', $tempOut, $matches)){
						$tempOut = trim($matches[1]);
					} else {
						$tempOut = '';
					}
					
					$out[$path[1]][$path[2]] = $tempOut;
					
				}
			}
			
		}
		
		return $out;
		
	}
	
	/**
	 * Prepares a web page with the specified content to be translated as a whole
	 * web page.
	 *
	 * @param string $key The unique key to identify this web page.
	 * @param string $value The value to be translated.
	 * @return string The url to the page with this content.
	 */
	function prepareWebpage($key, $value){
		$app =& Dataface_Application::getInstance();
		
		
		$sql = "REPLACE INTO `".$this->transpage_table."` 
			(`key`,`value`)
			VALUES
			('".addslashes($key)."','".addslashes($value)."')";
		
		$res = mysql_query($sql,$app->db());
		if ( !$res ){
			$this->createTranslationPageTable();
			$res = mysql_query($sql, $app->db());
		}
		
		if ( !$res ){
			return trigger_error(mysql_error($app->db()), E_USER_ERROR);
		}
		
		// Note that Google and most translation services won't work with
		// secure pages.  If our application is secure (using https), then 
		// we need to allow google to access the translation page insecurely.
		// By default 'https' will be changed to 'http'.  However if this 
		// simple switch isn't good enough (i.e. if your app isn't even 
		// available by http, then you will need to add another script
		// that will process this action but it available in http.
		$url = $app->url('-table=&-action=get_page_to_translate&key='.$key, false);
		$url = preg_replace('/-table=[^&]+/','',$url);
	
		if ( $url{strlen($url)-1} == '&' ) $url = substr($url, 0, strlen($url)-1);
		$url .= '&-dummy=1';
		if ( substr($url,0,5) == 'https' ){
			$url = preg_replace('/^https/', 'http', $url);
		}
		if ( @$app->_conf['translate_page_url'] ){
			list($url, $qs) = explode('?', $url);
			$url = $app->_conf['translate_page_url'].'?'.$qs;
		}
		return $url;
		
		
	}
	
	/**
	 * Clears a web page that was created for the purpose of translating an
	 * HTML field.
	 *
	 * @param string $key The key of the page to be cleared.
	 * @return boolean Result of operation.
	 */
	function clearWebpage($key){
		$app =& Dataface_Application::getInstance();
		$sql = "DELETE FROM `".$this->transpage_table."` WHERE `key`='".addslashes($key)."' limit 1";
		$res = mysql_query($sql, $app->db());
		if ( !$res ){
			return trigger_error(mysql_error($app->db()), E_USER_ERROR);
		}
		return true;
	}
	
	/**
	 * Creates a table to store the translation pages.  Translation pages
	 * are temporary web pages constructed with database content to be
	 * translated by the translator.
	 */
	function createTranslationPageTable(){
		$app =& Dataface_Application::getInstance();
		$sql = "CREATE TABLE `".$this->transpage_table."` (
			`key` VARCHAR(32) NOT NULL,
			`value` LONGTEXT,
			`created` TIMESTAMP,
			PRIMARY KEY (`key`)) DEFAULT CHARSET=utf8";
		$res = mysql_query($sql, $app->db());
		if ( !$res ){
			trigger_error(mysql_error($app->db()), E_USER_ERROR);
		}
		return true;
			
	}
	
	
	/**
	 * Returns a translation object that implements the translate()  method
	 * with parameters: 1. Text to be translated.
	 *					2. Source language code.
	 *					3. Dest language code.
	 */
	function getTranslator($type='Google'){
		switch (strtolower($type) ){
			case 'babelfish':
				import('BabelfishTranslate.class.php');
				return new BabelfishTranslate();
				
			default:
				import('GoogleTranslate.class.php');
				return new GoogleTranslate();
		}
	}
	
	function processForm($values){
		
		ini_set('max_execution_time', 900);
		import('Dataface/IO.php');
		import('Dataface/TranslationTool.php');
		
		$tt = new Dataface_TranslationTool();
		
		$app =& Dataface_Application::getInstance();
		$query =& $app->getQuery();
		if ( strlen($values['-sourceLanguage']) != 2 || strlen($values['-destinationLanguage']) != 2){
			trigger_error('Invalid input for languages.  Expected a 2 digit language code.', E_USER_ERROR);
		}
		
		$values['-limit'] = 500;
		//$qt = new Dataface_QueryTool($this->table->tablename, $app->db(), $values);
		//$qt->loadSet();
		//$it =& $qt->iterator();
		$q = $query;
		$q['-limit'] = 9999;
		if ( @$q['--limit'] ) $q['-limit'] = $q['--limit'];
		$it =& df_get_records($this->table->tablename, $q);
		$keycols = array_keys($this->table->keys());
		
		$cols = $this->table->getTranslation($values['-destinationLanguage']);
		if ( !is_array($cols) ) trigger_error('Could not find any columns to be translated in table '.$values['-destinationLanguage']. Dataface_Error::printStackTrace(), E_USER_ERROR);
		$babelfish = $this->getTranslator(); //new babelfish();
		if ( isset($app->_conf['google_translate_url']) ){
			$babelfish->google_url_webpage = $app->_conf['google_translate_url'];
			
		} 
		$ioSrc = new Dataface_IO($this->table->tablename);
		$ioSrc->lang = $values['-sourceLanguage'];
		$languageCodes = new I18Nv2_Language('en');
		
		$ioDest = new Dataface_IO($this->table->tablename);
		$ioDest->lang = $values['-destinationLanguage'];
		$count = 0;
		
		$to_be_translated = array();
		$destObjects = array();
		
		
		while ($it->hasNext()){
			
			$curr =& $it->next();
							
			$translationInfo =& $tt->getTranslationRecord($curr, $values['-destinationLanguage']);
			if ( $translationInfo and $translationInfo->val('translation_status') == TRANSLATION_STATUS_NEEDS_UPDATE_MACHINE ){
				$t_needsUpdate = true;
			} else {
				$t_needsUpdate = false;
			}
			
			$translation_text = array();
			$keyvals = $curr->vals($keycols);
			$srcObject = new Dataface_Record( $this->table->tablename, array());
			$destObject = new Dataface_Record( $this->table->tablename, array());
			$ioSrc->read($keyvals, $srcObject);
			$ioDest->read($keyvals, $destObject);
			$keyvalsQuery = $keyvals;
			foreach ($keyvals as $key=>$val){
				$keyvalsQuery[$key] = '='.$keyvals[$key];
			}
			$qb = new Dataface_QueryBuilder($this->table->tablename, $keyvalsQuery);
			$sql = "select * from `".$this->table->tablename."_".$values['-destinationLanguage']."` ".$qb->_where();
			$res = mysql_query($sql, $app->db());
			if ( !$res ){
				trigger_error(mysql_error($app->db()). 'SQL : '.$sql." Stacktrace:".Dataface_Error::printStackTrace(), E_USER_ERROR);
			}
			
			$queryResult = mysql_fetch_array($res);
			if ( !$queryResult ) $queryResult = array();
			foreach ($cols as $col ){
				if ( in_array($col, $keycols) ) continue;
				if ( !$this->table->isText($col) and !$this->table->isChar($col) ) continue;
				if ( !isset($queryResult[$col]) || $t_needsUpdate ){
					//$updateRequired = true;
				} else {
					continue;
				}
				
				$translation_text[$col] = $srcObject->getValue($col);
			}
			if ( count($translation_text) > 0 ) {
				$to_be_translated[] =& $translation_text;
				$destObjects[] =& $destObject;
			}
			
			unset($curr);
			unset($srcObject);
			unset($destObject);
			unset($qb);
			unset($translatedRecord);
			unset($translation_text);
			unset($translationInfo);

			
		}
		
		$translated = $this->translate($to_be_translated, $values['-sourceLanguage'], $values['-destinationLanguage'], $babelfish);
		if ( PEAR::isError($translated) ){
			return $translated;
		}
		foreach ( $translated as $rowid=>$row ){
			if ( $translated[$rowid] == $to_be_translated[$rowid] ) continue;
			$update = false;
			foreach ( $row as $col=>$val ){
				if ( strlen(trim($val)) === 0 ){
					continue;
				}
				$destObjects[$rowid]->setValue($col, $val);
				$update = true;
			
			}
			
			if ( $update ){
				$res = $ioDest->write($destObjects[$rowid]);
				if ( PEAR::isError($res) ){
					trigger_error($res->toString().Dataface_Error::printStackTrace(), E_USER_ERROR);
				}
				$tt->setTranslationStatus($destObjects[$rowid], $ioDest->lang, TRANSLATION_STATUS_MACHINE);
				
			}
		}
		
		
		
				
	}
}

?>