<?php
namespace OBB\Mediaserver;

class Asset {
  
  public $protocol    = "http://";
  public $server      = false;
  public $port        = false;
  public $server_key  = false;
  public $resource    = false;
  public $unsafe      = false;
  public $trim        = false;
  public $width       = 0;
  public $height      = 0;
  public $meta        = false;
  public $mode        = "smart";
  public $filters     = false;
  
  public function __construct($options = []) {
    foreach($options as $option=>$value) $this->$option = $value;
  }
  
  public function url($resource, $options = []) {
    $this->resource = $resource;
    foreach($options as $option=>$value) $this->$option = $value;
    return $this->build();
  }
  
  public function unsafe_url($resource, $options = []) {
    $this->url($resource, $options);
    $this->unsafe = true;
    return $this->build();
  }
  
  public function meta($resource, $options = []) {
    $this->url($resource, $options);
    $this->meta = true;
    return $this->build();
  }
  
  protected function command() {
    $command[] = $this->width . "x" . $this->height;
    $command[] = $this->mode;
    if($this->filters) $command[] = "filters:".$this->filters;
    $command[] = $this->resource;
    return implode("/", $command);
  }
  
  protected function build() {
    $url = $this->protocol.$this->server;
    if($this->port) $url.=":$this->port";
    $url .= "/". $this->hash_key()."/";
    if($this->meta) $url.="meta/";
    $url .= $this->command();
    return $url;
  }
  
  protected function hash_key() {
    if($this->unsafe) return "unsafe";
    if(!$this->server_key) return "unsafe";
    $encrypted_data = hash_hmac("sha1", $this->command(), $this->server_key, true);
    return strtr(base64_encode($encrypted_data ),'/+','_-');
  }
  
  
}