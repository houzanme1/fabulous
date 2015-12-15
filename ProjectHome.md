# FABULOUS #
### Fedora/Arrow Batch Utility with Lots of user Services ###

_**FABULOUS Version 3.0 in Development**_


#### Special features (version 3.0) ####
  * Support's fedora 2.X.X series
  * Pluggable into front-end applications such as VITAL etc.
  * Directly Interacts with fedora (Front end independent)
  * Open source platform independent
  * Simple and easy to use Interface
  * Web based application
  * Xml schema based validation in build
  * Form based xml editing interface
  * Identifier preservation incorporated for modified DC records
  * Support for AlternateID values.

_**FABULOUS Version 2.0 beta Released**_

#### functionalities ####
  * Support for fedora 2.1, 2.2 and 2.2.1
  * Selective purging (Bulk deletion)
  * Improved error messaging
  * Support for creating other metadata streams during batch edit process currently supports MODS.

_**FABULOUS Version 1.0**_

The objective of the batch utilities tool is to improve efficiency of repository content management by incorporating following functionalities
  * Batch activate datastreams
  * Batch de-activate datastreams
  * Link batches of content files to existing metadata
  * Edit batches of metadata files

#### Technical Architecture ####
The application utilises the SOAP interface provided by Fedora to implement various batch tasks. The PHP logic class translates the WSDL SOAP calls into PHP functions which are accessed by the various functionality modules such as activate.php, deactivate.php, etc.

The administrative login module authenticates the uses against the user ID and password information stored in the configuration file on the server. The application maintains sessions. At present the application does not support cookies.


_Fabulous Requires PHP version 5.1.2 and above http://www.php.net/ChangeLog-5.php#5.1.2_

_Configure php with xsl http://au3.php.net/manual/en/ref.xsl.php. By default this is turned off with version 5 of PHP._

_Currently Fabulous is tested with Fedora 2.0, development is under way to support Fedora 2.1 and later releases._


_NOTE:_
_Its advisable to keep the Fabulous parent directory as 'Fabulous'.
  * download the relevant software archive
  * uncompress the software
  * rename the parent directory to 'Fabulous'
  * copy it across to the document root of the web server (htdocs in apache and wwwroot in IIS)_