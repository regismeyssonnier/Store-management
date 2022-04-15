<?php
include_once(dirname(__FILE__).'/client.php');

class EoleCASClient extends CASClient
{
  /**
   * Fonction de gestion des détails utilisateurs
   * set et getDetails
   **/
  function setDetails($details){
      $this->details = $details;
  }
  function getDetails(){
      if ( empty($this->details)){
	  phpCAS::error('this method (getDetails) should be used only after '.__CLASS__.'::forceAuthentication() or '.__CLASS__.'::isAuthenticated()');
      }
  return $this->details;
  }
  /**
   * Fontions de gestion du xml renvoye par le sso eole
   * set et get CasXML
   * */
  function setCasXML($dom){
      $this->casxml = $dom;
  }
  function getCasXML(){
      if ( empty($this->casxml)){
	  phpCAS::error('this method (getCasXML) should be used only after '.__CLASS__.'::forceAuthentication() or '.__CLASS__.'::isAuthenticated()');
      }
      return $this->casxml;
  }
  // fonction de parsing du ticket Cas renvoyant les infos user et details
  function parseTicket($dom) {
	  /* format du retour à traiter:
		  <cas:authenticationSuccess>
		          <cas:section>
			       <cle1>valeur</cle1>
    			       <cle2>valeur</cle2>
			  </cas:section>
			  </cas:authenticationSuccess>

			  renvoie {section:{cle1:valeur, cle2:valeur}}
		ou
		<cas:authenticationSuccess>
		<cas:section>valeur</cas:section>
		</cas:authenticationSuccess>

		renvoie {section:valeur}
	   */
	  $details = array();
	  $user = "undefined";
	  // Pour chaque section
	  foreach($dom->child_nodes() as $section){
		  // si la section a des enfants
		  if ($section->has_child_nodes()){
			  $subdetails = array();
			  // on traite les sous-sections
			  foreach($section->child_nodes() as $node){
                  if ($node->node_name() != ""){
                    if (! isset($subdetails[$node->node_name()])){
    				    $subdetails[$node->node_name()] = Array($node->get_content());
                    }else{
                        $subdetails[$node->node_name()][] = $node->get_content();
                    }
				}
              }

			  if (sizeof($subdetails) == 0){
				  $subdetails = $section->get_content();
			  }
              if ($section->node_name() != ""){
                      $details[$section->node_name()] = $subdetails;
			  }
		  }
		  // si elle est elle-meme la cle
		  else{
			  if ($section->node_name() != ""){
				  $details[$section->node_name()] = $section->get_content();
			  }
		  }
	  }
	  // on récupère le nom de l'utilisateur (inclue dans le comportement traditionnel de la lib CAS)
      if (isset($details['user'])){
          if (is_array($details['user'])){
                  if (isset($details['user']['user'])){
                      if (is_array($details['user']['user'])){
                       $user = $details['user']['user'][0];
                      }else{
                       $user = $details['user']['user'];
                   }
                  }else{
                  $user = $details['user'][0];
              }
          }else{
              $user = $details['user'];

          }
	  }
	return array($user, $details);
  }
  /* isAuthenticated : ici on écrit les variables dans l'objet de session */
  function isAuthenticated()
  {
      phpCAS::traceBegin();
      $res = FALSE;
      $validate_url = '';

      if ( $this->wasPreviouslyAuthenticated() ) {
	  	 // the user has already (previously during the session) been
		 // authenticated, nothing to be done.
    	phpCAS::trace('user was already authenticated, no need to look for tickets');
    	$res = TRUE;
      }
	  elseif ( $this->hasST() ) {
    	// if a Service Ticket was given, validate it
    	phpCAS::trace('ST `'.$this->getST().'\' is present');
    	$this->validateST($validate_url,$text_response,$tree_response); // if it fails, it halts
    	phpCAS::trace('ST `'.$this->getST().'\' was validated');
    	if ( $this->isProxy() ) {
		   $this->validatePGT($validate_url,$text_response,$tree_response); // idem
		   phpCAS::trace('PGT `'.$this->getPGT().'\' was validated');
		   $_SESSION['phpCAS']['pgt'] = $this->getPGT();
		}
	$_SESSION['phpCAS']['user'] = $this->getUser();
	// Specification Eole
        $_SESSION['phpCAS']['details'] = $this->getDetails();
        $_SESSION['phpCAS']['casxml'] = $this->getCasXML();
		$res = TRUE;
	}
	  elseif ( $this->hasPT() ) {
		// if a Proxy Ticket was given, validate it
		phpCAS::trace('PT `'.$this->getPT().'\' is present');
		$this->validatePT($validate_url,$text_response,$tree_response); // note: if it fails, it halts
		phpCAS::trace('PT `'.$this->getPT().'\' was validated');
		if ( $this->isProxy() ) {
		   $this->validatePGT($validate_url,$text_response,$tree_response); // idem
		   phpCAS::trace('PGT `'.$this->getPGT().'\' was validated');
		   $_SESSION['phpCAS']['pgt'] = $this->getPGT();
		}
    		$_SESSION['phpCAS']['user'] = $this->getUser();
		// Specification Eole
        $_SESSION['phpCAS']['details'] = $this->getDetails();
        $_SESSION['phpCAS']['casxml'] = $this->getCasXML();
		$res = TRUE;
	}
	else {
    	// no ticket given, not authenticated
    	phpCAS::trace('no ticket found');
	}

	phpCAS::traceEnd($res);
	return $res;
  }
  /* On est déjà authentifié, on récupère les valeurs dans la session */
  function wasPreviouslyAuthenticated()
    {
      phpCAS::traceBegin();

      if ( $this->isCallbackMode() ) {
	$this->callback();
      }

      $auth = FALSE;

      if ( $this->isProxy() ) {
	// CAS proxy: username and PGT must be present
	if ( $this->isSessionAuthenticated() && !empty($_SESSION['phpCAS']['pgt']) ) {
	  // authentication already done
		$this->setUser($_SESSION['phpCAS']['user']);

      	  // Specification Eole
	   if (isset($_SESSION['phpCAS']['details'])){
		   $this->setDetails($_SESSION['phpCAS']['details']);
	   }
	   else{
		   $this->setDetails('__Void__');
	   }
        if (isset($_SESSION['phpCAS']['casxml'])){
            $this->setCasXML($_SESSION['phpCAS']['casxml']);
        }
        else{
            $this->setCasXML("__VoidXML___");
        }
	  $this->setPGT($_SESSION['phpCAS']['pgt']);
	  phpCAS::trace('user = `'.$_SESSION['phpCAS']['user'].'\', PGT = `'.$_SESSION['phpCAS']['pgt'].'\'');
	  $auth = TRUE;
	} elseif ( $this->isSessionAuthenticated() && empty($_SESSION['phpCAS']['pgt']) ) {
	  // these two variables should be empty or not empty at the same time
	  phpCAS::trace('username found (`'.$_SESSION['phpCAS']['user'].'\') but PGT is empty');
	  // unset all tickets to enforce authentication
	  unset($_SESSION['phpCAS']);
	  $this->setST('');
	  $this->setPT('');
	} elseif ( !$this->isSessionAuthenticated() && !empty($_SESSION['phpCAS']['pgt']) ) {
	  // these two variables should be empty or not empty at the same time
	  phpCAS::trace('PGT found (`'.$_SESSION['phpCAS']['pgt'].'\') but username is empty');
	  // unset all tickets to enforce authentication
	  unset($_SESSION['phpCAS']);
	  $this->setST('');
	  $this->setPT('');
	} else {
	  phpCAS::trace('neither user not PGT found');
	}
      } else {
	// `simple' CAS client (not a proxy): username must be present
	if ( $this->isSessionAuthenticated() ) {
	  // authentication already done
		$this->setUser($_SESSION['phpCAS']['user']);

	  // Specification pour les détails
	   if (isset($_SESSION['phpCAS']['details'])){
		   $this->setDetails($_SESSION['phpCAS']['details']);
	   }
	   else{
		   $this->setDetails("__Void___");
       }
        if (isset($_SESSION['phpCAS']['casxml'])){
            $this->setCasXML($_SESSION['phpCAS']['casxml']);
        }
        else{
            $this->setCasXML("__VoidXML___");
        }

	  phpCAS::trace('user = `'.$_SESSION['phpCAS']['user'].'\'');
	  $auth = TRUE;
	} else {
	  phpCAS::trace('no user found');
	}
      }

      phpCAS::traceEnd($auth);
      return $auth;
    }
  function validatePT(&$validate_url,&$text_response,&$tree_response)
    {
      phpCAS::traceBegin();
      // build the URL to validate the ticket
      $validate_url = $this->getServerProxyValidateURL().'&ticket='.$this->getPT();

      if ( $this->isProxy() ) {
      // pass the callback url for CAS proxies
	$validate_url .= '&pgtUrl='.$this->getCallbackURL();
      }

      // open and read the URL
      if ( !$this->readURL($validate_url,''/*cookies*/,$headers,$text_response,$err_msg) ) {
	phpCAS::trace('could not open URL \''.$validate_url.'\' to validate ('.$err_msg.')');
	$this->authError('PT not validated',
			 $validate_url,
			 TRUE/*$no_response*/);
      }

      // read the response of the CAS server into a DOM object
      if ( !($dom = domxml_open_mem($text_response))) {
	// read failed
	$this->authError('PT not validated',
		     $validate_url,
		     FALSE/*$no_response*/,
		     TRUE/*$bad_response*/,
		     $text_response);
      }
      // read the root node of the XML tree
      if ( !($tree_response = $dom->document_element()) ) {
	// read failed
	$this->authError('PT not validated',
		     $validate_url,
		     FALSE/*$no_response*/,
		     TRUE/*$bad_response*/,
		     $text_response);
      }
      // insure that tag name is 'serviceResponse'
      if ( $tree_response->node_name() != 'serviceResponse' ) {
	// bad root node
	$this->authError('PT not validated',
		     $validate_url,
		     FALSE/*$no_response*/,
		     TRUE/*$bad_response*/,
		     $text_response);
      }
      if ( sizeof($arr = $tree_response->get_elements_by_tagname("authenticationSuccess")) != 0) {
	// authentication succeded, extract the user name
	if ( sizeof($arr = $tree_response->get_elements_by_tagname("user")) == 0) {
	  // no user specified => error
	  $this->authError('PT not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
    $user_datas_tag = $tree_response->get_elements_by_tagname("authenticationSuccess");
    $this->setCasXML($text_response);
	$datas = $this->parseTicket($user_datas_tag[0]);
	$this->setUser($datas[0]);
	// Specifications Eole
    $this->setDetails($datas[1]);


      } else if ( sizeof($arr = $tree_response->get_elements_by_tagname("authenticationFailure")) != 0) {
	// authentication succeded, extract the error code and message
	$this->authError('PT not validated',
		     $validate_url,
		     FALSE/*$no_response*/,
		     FALSE/*$bad_response*/,
		     $text_response,
		     $arr[0]->get_attribute('code')/*$err_code*/,
		     trim($arr[0]->get_content())/*$err_msg*/);
      } else {
	$this->authError('PT not validated',
		     $validate_url,
		     FALSE/*$no_response*/,
		     TRUE/*$bad_response*/,
		     $text_response);
      }

      // at this step, PT has been validated and $this->_user has been set,

      phpCAS::traceEnd(TRUE);
      return TRUE;
    }

  function validateST($validate_url,&$text_response,&$tree_response)
    {
      phpCAS::traceBegin();
      // build the URL to validate the ticket
      $validate_url = $this->getServerServiceValidateURL().'&ticket='.$this->getST();
      if ( $this->isProxy() ) {
	  	 // pass the callback url for CAS proxies
		 $validate_url .= '&pgtUrl='.$this->getCallbackURL();
      }

      // open and read the URL
      if ( !$this->readURL($validate_url,''/*cookies*/,$headers,$text_response,$err_msg) ) {
	phpCAS::trace('could not open URL \''.$validate_url.'\' to validate ('.$err_msg.')');
	$this->authError('ST not validated',
			 $validate_url,
			 TRUE/*$no_response*/);
      }

      // analyze the result depending on the version
      switch ($this->getServerVersion()) {
      case CAS_VERSION_1_0:
	if (preg_match('/^no\n/',$text_response)) {
	  phpCAS::trace('ST has not been validated');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       FALSE/*$bad_response*/,
		       $text_response);
	}
	if (!preg_match('/^yes\n/',$text_response)) {
	  phpCAS::trace('ill-formed response');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
	// ST has been validated, extract the user name
	$arr = preg_split('/\n/',$text_response);
	$this->setUser(trim($arr[1]));

	// Specification Eole (pas d'infos user en Cas 1)
	$this->setDetails("NO INFOS");
	$this->setCasXML("NO XML");

	break;
      case CAS_VERSION_2_0:
	// read the response of the CAS server into a DOM object
	if ( !($dom = domxml_open_mem($text_response))) {
	  phpCAS::trace('domxml_open_mem() failed');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
	// read the root node of the XML tree
	if ( !($tree_response = $dom->document_element()) ) {
	  phpCAS::trace('document_element() failed');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
	// insure that tag name is 'serviceResponse'
	if ( $tree_response->node_name() != 'serviceResponse' ) {
	  phpCAS::trace('bad XML root node (should be `serviceResponse\' instead of `'.$tree_response->node_name().'\'');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
	if ( sizeof($success_elements = $tree_response->get_elements_by_tagname("authenticationSuccess")) != 0) {
	  // authentication succeded, extract the user name
	  if ( sizeof($user_elements = $success_elements[0]->get_elements_by_tagname("user")) == 0) {
	    phpCAS::trace('<authenticationSuccess> found, but no <user>');
	    $this->authError('ST not validated',
			 $validate_url,
			 FALSE/*$no_response*/,
			 TRUE/*$bad_response*/,
			 $text_response);
	  }

		$user_datas_tag = $tree_response->get_elements_by_tagname("authenticationSuccess");
	  $datas = $this->parseTicket($user_datas_tag[0]);
        $this->setCasXML($text_response);
		$this->setUser($datas[0]);
		// Specification Eole
		$this->setDetails($datas[1]);

	} else if ( sizeof($failure_elements = $tree_response->get_elements_by_tagname("authenticationFailure")) != 0) {
	  phpCAS::trace('<authenticationFailure> found');
	  // authentication failed, extract the error code and message
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       FALSE/*$bad_response*/,
		       $text_response,
		       $failure_elements[0]->get_attribute('code')/*$err_code*/,
		       trim($failure_elements[0]->get_content())/*$err_msg*/);
	} else {
	  phpCAS::trace('neither <authenticationSuccess> nor <authenticationFailure> found');
	  $this->authError('ST not validated',
		       $validate_url,
		       FALSE/*$no_response*/,
		       TRUE/*$bad_response*/,
		       $text_response);
	}
	break;
      }

      // at this step, ST has been validated and $this->_user has been set,
      phpCAS::traceEnd(TRUE);
      return TRUE;
    }
}

