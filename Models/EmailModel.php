<?php

namespace App\Models;

class EmailModel extends Model
{
private $id;
private $name;
private $email;
private $object_message;
private $message;
private $paiement;
private $date;
private $offre;



/**
 * Get the value of id
 */
public function getId()
{
return $this->id;
}

/**
 * Set the value of id
 *
 * @return  self
 */
public function setId($id)
{
$this->id = $id;

return $this;
}

/**
 * Get the value of name
 */
public function getName()
{
return $this->name;
}

/**
 * Set the value of name
 *
 * @return  self
 */
public function setName($name)
{
$this->name = $name;

return $this;
}

/**
 * Get the value of email
 */
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @return  self
 */
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Get the value of object_message
 */
public function getObject_message()
{
return $this->object_message;
}

/**
 * Set the value of object_message
 *
 * @return  self
 */
public function setObject_message($object_message)
{
$this->object_message = $object_message;

return $this;
}


/**
 * Get the value of message
 */
public function getMessage()
{
return $this->message;
}

/**
 * Set the value of message
 *
 * @return  self
 */
public function setMessage($message)
{
$this->message = $message;

return $this;
}

/**
 * Get the value of paiement
 */
public function getPaiement()
{
return $this->paiement;
}

/**
 * Set the value of paiement
 *
 * @return  self
 */
public function setPaiement($paiement)
{
$this->paiement = $paiement;

return $this;
}

/**
 * Get the value of date
 */
public function getDate()
{
return $this->date;
}

/**
 * Set the value of date
 *
 * @return  self
 */
public function setDate($date)
{
$this->date = $date;

return $this;
}

/**
 * Get the value of offre
 */
public function getOffre()
{
return $this->offre;
}

/**
 * Set the value of offre
 *
 * @return  self
 */
public function setOffre($offre)
{
$this->offre = $offre;

return $this;
}
}