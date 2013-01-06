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


### Width & Height Generation

In it's simplest usage, just specify a desired width and height and an image will be served, cropped where necessary, to match the required dimensions.

#### Ratio dependent generation

Simply replace the pro-ratio dimension with a zero. For example:

    $img_settings = [
      "width"=>700,
      "height"=>0,
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
    
Results in this image: http://m1.obb.im/tKqROt8jn_Sp-Bvm81IZOzLzRlU=/700x0/right/isuzu.co.uk/m/7c67e8/860.jpg

For the inverse:

    $img_settings = [
      "width"=>0,
      "height"=>400,
    ];
    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg", $img_settings);
    
Gets this image: http://m1.obb.im/B6OnIQHxbuV_9zfNXva6Xvgsiqg=/0x400/right/isuzu.co.uk/m/7c67e8/860.jpg


#### Original Size

Finally, you can specify both width and height as zero to receive the original size back. Note that since this is the default for width and height you can just do this:

    $url = $asset->url("isuzu.co.uk/m/7c67e8/860.jpg");
    
That will give the following image: http://m1.obb.im/nuXfoLZ9umswOZvg7reqeg9lYTo=/0x0/smart/isuzu.co.uk/m/7c67e8/860.jpg