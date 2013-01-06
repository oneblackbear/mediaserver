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



