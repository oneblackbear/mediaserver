<?php
namespace OBB\Mediaserver\Tests;
use OBB\Mediaserver\Asset;

class AssetTest extends \PHPUnit_Framework_TestCase {


  public function setup() {
    $example_settings = [
      "server"=>      "example.com",
      "server_key"=>  "123secret"
    ];
    $this->asset = new Asset($example_settings);
  }
  
  public function teardown() {}
  
  public function test_default_url() {
    $img_settings = [
      "width"=>600,
      "height"=>500,
    ];
    $url = $this->asset->url("example.com/image.jpg", $img_settings);
    $expected = "http://example.com/4nB7OmYXS1Duobw_1bhp9QcJImw=/600x500/smart/example.com/image.jpg";
    $this->assertEquals($expected, $url);
  }
  
  
  

}