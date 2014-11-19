<?php
/**
 * sipgate.io XML generator class
 *
 * Licensed under the WTFPL: http://www.wtfpl.net/
 * TL;DR: Do what the f*ck you want with this. :-)
 *
 * Generates XML using PHP's DOMDocument class with an easy-to-use interface
 */

class SipgateIO {

	/**
	 * @var DOMDocument
	 */
	private $dom;

	/**
	 * @var DOMNode
	 */
	private $response;

	/**
	 * Class constructor
	 *
	 * @param DOMDocument $dom for dependency injection purposes
	 * @param String $charset to use an alternate charset
	 */
	public function __construct(DOMDocument $dom = null, String $charset = null) {
		if(isset($dom)) {
			$this->dom = $dom;
		} else {
			$this->dom = new DOMDocument("1.0",($charset ? $charset : "UTF-8"));
		}

		$this->response = $this->dom->createElement('Response');
		$this->dom->appendChild($this->response);
	}

	/**
	 * Play a sound file from the given URL
	 *
	 * @param String $url the URL of the sound file
	 */
	public function play(String $url) {
		$play = $this->dom->createElement('Play');
		$url = $this->dom->createElement('Url',$url);
		$play->appendChild($url);
		$this->response->appendChild($play);
	}

	/**
	 * Say something (not yet implemented, but chances are good this will happen... :-))
	 *
	 * @param String $text the text that should be said
	 */
	public function say(String $text) {
		$say = $this->dom->createElement('Say',$text);
		$this->response->appendChild($say);
	}

	/**
	 * Reject a call
	 *
	 * @param String $reason the reason. Currently only "busy" and "rejected" are supported
	 */
	public function reject(String $reason = null) {
		$reject = $this->dom->createElement('Reject');

		if(isset($reason)) {
			$rejectReason = $this->dom->createAttribute('reason');
			$rejectReason->value = $reason;
			$reject->appendChild($rejectReason);
		}

		$this->response->appendChild($reject);
	}

	/**
	 * Call a number (e.g. to forward the incoming call)
	 *
	 * @param String $number the number to be dialled in E164 (http://de.wikipedia.org/wiki/E.164) format, e.g. "4915799912345"
	 */
	public function dial(String $number) {
		$dial = $this->dom->createElement('Dial');
		$number = $this->dom->createElement('Number',$number);
		$dial->appendChild($number);
		$this->response->appendChild($dial);
	}

	/**
	 * Send call to voicemail
	 */
	public function voicemail() {
		$dial = $this->dom->createElement('Dial');
		$voicemail = $this->dom->createElement('Voicemail');
		$dial->appendChild($voicemail);
		$this->response->appendChild($dial);
	}

	/**
	 * Use a custom tag with a given custom value (For future use or regression testing)
	 *
	 * @param String $tagName the custom tag's name
	 * @param String $tagValue the value to be put between the custom tags
	 */
	public function customTag(String $tagName, String $tagValue = null) {
		$customTag = $this->dom->createElement($tagName,$tagValue);
		$this->response->appendChild($customTag);
	}

	/**
	 * Hang up the call
	 */
	public function hangup() {
		$hangup = $this->dom->createElement('Hangup');
		$this->response->appendChild($hangup);
	}

	/**
	 * Get the response XML as string
	 *
	 * @return string the response XML
	 */
	public function getResponseXML() {
		return $this->dom->saveXML();
	}

}
