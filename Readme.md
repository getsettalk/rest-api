# How to use this api at live server on hostinger
 > Follow these step 
 :heavy_check_mark
  - Change in index.php file (Comment this codes) :heavy_check_mark
   ``
   Line-5 : $request_uri = str_replace('/rimeso_network', '', $request_uri);
   ``
   - Change in .htaccess file (comment this)

   ``
   Line 2: RewriteBase /rimeso_network/
   ``  