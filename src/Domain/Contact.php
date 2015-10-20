<?php

namespace ananasanam\Domain;

class Contact {

	private $contact_name;
	private $contact_email;
	private $contact_msg;

	public function getContactName() {
		return $this->contact_name;
	}

	public function setContactName() {
		$this->contact_name = $contact_name;
	}

	public function getContactEmail() {
		return $this->contact_email;
	}

	public function setContactEmail() {
		$this->contact_email = $contact_email;
	}

	public function getContactMessage() {
		return $this->contact_msg;
	}

	public function setContactMessage() {
		$this->contact_msg = $contact_msg;
	}
}