<?php

class SipgateIO {

	/**
	 * @var DOMDocument
	 */
	private $dom;

	/**
	 * @var DOMNode
	 */
	private $response;

	public function __construct($dom = null, $charset = null) {
		if(isset($dom)) {
			$this->dom = $dom;
		} else {
			$this->dom = new DOMDocument("1.0",$charset);
		}

		$this->response = $this->dom->createElement('Response');
		$this->dom->appendChild($this->response);
	}

	public function play($url) {
		$play = $this->dom->createElement('Play');
		$url = $this->dom->createElement('Url',$url);
		$play->appendChild($url);
		$this->response->appendChild($play);
	}

	public function say($text) {
		$say = $this->dom->createElement('Say',$text);
		$this->response->appendChild($say);
	}

	public function reject($reason = null) {
		$reject = $this->dom->createElement('Reject');

		if(isset($reason)) {
			$rejectReason = $this->dom->createAttribute('reason');
			$rejectReason->value = $reason;
			$reject->appendChild($rejectReason);
		}

		$this->response->appendChild($reject);
	}

	public function dial($number) {
		$dial = $this->dom->createElement('Dial');
		$number = $this->dom->createElement('Number',$number);
		$dial->appendChild($number);
		$this->response->appendChild($dial);
	}

	public function voicemail() {
		$dial = $this->dom->createElement('Dial');
		$voicemail = $this->dom->createElement('Voicemail');
		$dial->appendChild($voicemail);
		$this->response->appendChild($dial);
	}

	public function customTag($tagName,$tagValue = null) {
		$customTag = $this->dom->createElement($tagName,$tagValue);
		$this->response->appendChild($customTag);
	}

	public function hangup() {
		$hangup = $this->dom->createElement('Hangup');
		$this->response->appendChild($hangup);
	}

	public function getResponseXML() {
		return $this->dom->saveXML();
	}

}
