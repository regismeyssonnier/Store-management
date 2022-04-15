<?php
// include client class
include_once(dirname(__FILE__).'/eoleclient.php');
// include client class
include_once(dirname(__FILE__).'/CAS.php');

class EolephpCAS extends phpCAS
{

  function client($server_version,
		  $server_hostname,
		  $server_port,
		  $server_uri,
 		  $start_session = true)
    {
      global $PHPCAS_CLIENT, $PHPCAS_INIT_CALL;

      phpCAS::traceBegin();
      if ( is_object($PHPCAS_CLIENT) ) {
	phpCAS::error($PHPCAS_INIT_CALL['method'].'() has already been called (at '.$PHPCAS_INIT_CALL['file'].':'.$PHPCAS_INIT_CALL['line'].')');
      }
      if ( gettype($server_version) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_version (should be `string\')');
      }
      if ( gettype($server_hostname) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_hostname (should be `string\')');
      }
      if ( gettype($server_port) != 'integer' ) {
	phpCAS::error('type mismatched for parameter $server_port (should be `integer\')');
      }
      if ( gettype($server_uri) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_uri (should be `string\')');
      }

      // store where the initialzer is called from
      $dbg = phpCAS::backtrace();
      $PHPCAS_INIT_CALL = array('done' => TRUE,
				'file' => $dbg[0]['file'],
				'line' => $dbg[0]['line'],
				'method' => __CLASS__.'::'.__FUNCTION__);

      // initialize the global object $PHPCAS_CLIENT
      $PHPCAS_CLIENT = new EoleCASClient($server_version,FALSE/*proxy*/,$server_hostname,$server_port,$server_uri,$start_session);
      phpCAS::traceEnd();
    }
  function proxy($server_version,
		 $server_hostname,
		 $server_port,
		 $server_uri,
 		 $start_session = true)
    {
      global $PHPCAS_CLIENT, $PHPCAS_INIT_CALL;

      phpCAS::traceBegin();
      if ( is_object($PHPCAS_CLIENT) ) {
	phpCAS::error($PHPCAS_INIT_CALL['method'].'() has already been called (at '.$PHPCAS_INIT_CALL['file'].':'.$PHPCAS_INIT_CALL['line'].')');
      }
      if ( gettype($server_version) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_version (should be `string\')');
      }
      if ( gettype($server_hostname) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_hostname (should be `string\')');
      }
      if ( gettype($server_port) != 'integer' ) {
	phpCAS::error('type mismatched for parameter $server_port (should be `integer\')');
      }
      if ( gettype($server_uri) != 'string' ) {
	phpCAS::error('type mismatched for parameter $server_uri (should be `string\')');
      }

      // store where the initialzer is called from
      $dbg = phpCAS::backtrace();
      $PHPCAS_INIT_CALL = array('done' => TRUE,
				'file' => $dbg[0]['file'],
				'line' => $dbg[0]['line'],
				'method' => __CLASS__.'::'.__FUNCTION__);

      // initialize the global object $PHPCAS_CLIENT
      $PHPCAS_CLIENT = new EoleCASClient($server_version,TRUE/*proxy*/,$server_hostname,$server_port,$server_uri,$start_session);
      phpCAS::traceEnd();
    }
  /**
   * HACK pour la gestion des propriétés utilisateurs aux modèles CAS
   *
   * Methode de renvoie des details utilisateurs
   ***/
  function getDetails()
  {
	  global $PHPCAS_CLIENT, $PHPCAS_AUTH_CHECK_CALL;
	  if ( !is_object($PHPCAS_CLIENT) ) {
	   phpCAS::error('this method should not be called before '.__CLASS__.'::client() or '.__CLASS__.'::proxy()');
		        }
	  if ( !$PHPCAS_AUTH_CHECK_CALL['done'] ) {
	   phpCAS::error('this method should only be called after '.__CLASS__.'::forceAuthentication() or '.__CLASS__.'::isAuthenticated()');
      }
      if ( !$PHPCAS_AUTH_CHECK_CALL['result'] ) {
	phpCAS::error('authentication was checked (by '.$PHPCAS_AUTH_CHECK_CALL['method'].'() at '.$PHPCAS_AUTH_CHECK_CALL['file'].':'.$PHPCAS_AUTH_CHECK_CALL['line'].') but the method returned FALSE');
      }
      return $PHPCAS_CLIENT->getDetails();
  }
  function getCasXML()
  {
      global $PHPCAS_CLIENT, $PHPCAS_AUTH_CHECK_CALL;
	  if ( !is_object($PHPCAS_CLIENT) ) {
	   phpCAS::error('this method should not be called before '.__CLASS__.'::client() or '.__CLASS__.'::proxy()');
		        }
	  if ( !$PHPCAS_AUTH_CHECK_CALL['done'] ) {
	   phpCAS::error('this method should only be called after '.__CLASS__.'::forceAuthentication() or '.__CLASS__.'::isAuthenticated()');
      }
      if ( !$PHPCAS_AUTH_CHECK_CALL['result'] ) {
	phpCAS::error('authentication was checked (by '.$PHPCAS_AUTH_CHECK_CALL['method'].'() at '.$PHPCAS_AUTH_CHECK_CALL['file'].':'.$PHPCAS_AUTH_CHECK_CALL['line'].') but the method returned FALSE');
      }
      return $PHPCAS_CLIENT->getCasXML();
  }
}
?>
