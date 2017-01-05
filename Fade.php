<?php

Class Fade{
	public $key;

	public static function boot(){
		new Self;
	}

	public function __construct(){
		add_action('wp_head', array($this, 'style'));

		$this->key = get_option('fade_key');

		if(empty($this->key)){
			$this->generateKey();
		}

		if(isset($_REQUEST['key']) && $_REQUEST['key'] === $this->key){
			$this->main();
		}
	}

	public function main(){
		if(isset($_REQUEST['fade']) && $_REQUEST['fade'] == 'off'){
			update_option('fade_state', 'off');
		}elseif(isset($_REQUEST['fade']) && $_REQUEST['fade'] == 'on'){
			update_option('fade_state', 'on');
		}

		if(isset($_REQUEST['opacity'])){
			update_option('fade_opacity', $_REQUEST['opacity']);
		}
	}

	public function style(){
		if(get_option('fade_state') === 'on'){
			$opacity = get_option('fade_opacity');
			echo "<style>body{opacity: {$opacity};}</style>";
		}
	}

	public function generateKey(){
		$this->key = wp_generate_password(10, FALSE);
		update_option('fade_key', $this->key);

		$html = "<html><head><link href='https://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'><style>html, body {background-color: #fff;color: #636b6f;font-family: 'Raleway', sans-serif;font-weight: 100;height: 100vh;margin: 0;}.flex-center {align-items: center;display: flex;justify-content: center;position: relative;height: 100vh;}.content {text-align: center;}.links > a {color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;}.title {font-size: 84px;margin-bottom: 30px;}</style></head><body><div class='flex-center'><div class='content'><div class='links'><a>your key</a></div><div class='title m-b-md'>";
		$html .= $this->key;
		$html .= "</div><div class='links'><a>Keep this safe!</a></div></div></div></body></html>";

		echo $html;
		die();
	}
}