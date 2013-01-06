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

### Additional Options

Smart cropping is the default, since it uses OpenCV to detect the primary but you can also override this to force a preferred crop.

Take this example image:
http://isuzu.co.uk/m/7c67e8/860.jpg

This is the default smart crop using the following:

    $img_settings = [
      "width"=>600,
      "height"=>500,
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
http://m1.obb.im/apLfSdsm7Y2ViSPdn6d7zekZ44g=/600x500/smart/isuzu.co.uk/m/7c67e8/860.jpg

#### Center Crop

    $img_settings = [
      "width" =>600,
      "height"=>500,
      "mode"  =>"center"
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
    
http://m1.obb.im/d647itICnSyd8PCXf4NlXdbsX_o=/600x500/center/isuzu.co.uk/m/7c67e8/860.jpg

#### Left Crop

    $img_settings = [
      "width" =>600,
      "height"=>500,
      "mode"  =>"left"
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
    
http://m1.obb.im/Zme6sT9kw4KpU-Y-7wq2RpErqTM=/600x500/left/isuzu.co.uk/m/7c67e8/860.jpg

#### Right Crop

    $img_settings = [
      "width" =>600,
      "height"=>500,
      "mode"  =>"right"
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
    
http://m1.obb.im/G6WHVA-0O8Y958TFb4uM06gGj2Y=/600x500/right/isuzu.co.uk/m/7c67e8/860.jpg
