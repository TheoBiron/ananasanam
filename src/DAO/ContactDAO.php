<?php

namespace ananasanam\DAO;

use ananasanam\Domain\Contact;

class ContactDAO extends DAO {

	public function sendMsg(Contact $contact) {
		$contactData = array(
			'contact_name' => $contact->getContactName(),
			'contact_email' => $contact->getContactEmail(),
			'contact_msg' => $contact->getContactMessage()
			);

		$this->getDb()->insert('contact', $contactData);
	}

	protected function buildDomainObject($row) {
    $contact = new Contact();
    $contact->setContactName($row['contact_name']);
    $contact->setContactEmail($row['contact_email']);
    $contact->setContactMessage($row['contact_msg']);
    return $contact;
    }
}