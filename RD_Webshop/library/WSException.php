<?php
  
    /**
     *
     * Exception Class for handling web shop exceptions
     *
     * @package    system
     * @author     Derrick Choo
     * @version     SVN: $Id$
     *
     */
     class WSException extends Exception
    {
        private $messages;
      
        /**
        * WSException Constructor
        * 
        * @param mixed $error
        * @param mixed $data
        * @return WSException
        */
        public function __construct($error, $data=null)
        {
          // Load error messages
          $this->loadMessages();
          
          // Get the error message
          $errorMsg = $this->getError($error);
          
          parent::__construct($errorMsg);
        }

        /**
        * Get the Error message
        * 
        * @param mixed $error
        * @return mixed Error Message
        */
        private function getError($error)
        {
          return $this->message['errorMessages'][$error];
        }

        /**
        * Get all error messages in message config file
        * 
        */
        private function loadMessages()
        {
          $this->message = include dirname(__FILE__).'/../include/messages.php';
        }
    }
?>
