#One Black Bear Mediaserver

Delegate image serving and resizing to a more powerful server, whilst maintaining a single local copy.

## Installation

Installation is via composer for example add this to your composer.json:

    "require": {
      "php": ">=5.4",
      "oneblackbear/mediaserver": "1.0.*"
    }
    


## USAGE

For simple out of the box usage you will need the following configuration items

* The server acting as a media server
* A private security key (which will prevent abuse by unauthorised users)
* A full url to an image you would like to serve.


### Basic Example

Use the following code to get up and running.

    <?php
    use OBB\Mediaserver\Asset;
    
    $server = [
      "server"=>     "example.co.uk",
      "server_key"=> "secretexample"
    ];
    
    $options = [
      "width"=>  300,
      "height"=> 300
    ];
    
    $asset = new Asset($server);
    $url = $asset->url("http://path/to/image.jpg", $options);
    // Example output:
    // http://example.co.uk/4nB7OmYXS1Duobw_1bhp9QcJImw=/300x300/smart/http://path/to/image.jpg

### Served image example

http://m1.obb.im/ViIPnXE3v-e8kJWaUYBpGmKIbGU=/600x500/smart/isuzu.co.uk/m/81e072/1200.jpg

The full url component is made up of 5 main parts.

* The media server, in the example case "http://m1.obb.im"
* The security signature eg: `ViIPnXE3v-e8kJWaUYBpGmKIbGU=`
* The requested width and height as passed into the options
* The display mode, in this case the default mode is `smart`
* The url of the original image


    

