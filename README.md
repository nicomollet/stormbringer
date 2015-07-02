Stormbringer
=================

Stormbringer is a starting WordPress theme based on Bootstrap from Twitter. Created by Nicolas Mollet (http://twitter.com/nicomollet).

It includes many functions from:

* Bones (https://github.com/eddiemachado/bones)
* Alien Ship (https://github.com/mindctrl/alienship)
* Roots (https://github.com/retlehs/roots)
* Wordpress Bootstrap (https://github.com/320press/wordpress-bootstrap)

Features
-----------

* Grunt configuration for scss compilation
* LessPHP: Less server-side compilation with PHP for anonymous users (file is cached)
* Less.js: serves .less files for admin users
* Gravity Forms integration
* Gallery with caption over the thumbnail
* JS and CSS libraries are called from cdnjs
* Includes Lightbox for Bootstrap 3 by @ashleydw

Installation
-----------

### Scss preprocessor
If you want to use Scss preprocessor, define preprocessor to "scss" in functions.php

Requirements: Ruby, Sass, Grunt

Install grunt locally:

`npm install`

`npm install -g grunt-cli`

To enable LiveReload, add `define('LIVERELOAD', true);` to your `wp-config.php` file.

To start watching files with Grunt, do:

`grunt`

Edit `scss/application.scss` then insert your custom styles

### Less preprocessor
If you want to use Less preprocessor, define preprocessor to "less" in functions.php

Edit `less/_application.less` then insert your custom styles


How-to
-----------

Custom styles in the rich-text editor: https://gist.github.com/nicomollet/4b022a3204ab96314da9

Addthis share buttons:
* With icons in a custom order: https://gist.github.com/nicomollet/b9b3a366e0c9c29de43c
* With a custom sharing URL: https://gist.github.com/nicomollet/0aacba0b2170ba6e35e8

Customize the admin scheme: https://gist.github.com/nicomollet/7fd3e2e5334ef352abe0


Major components 
-----------

* HTML5 Boilerplate: The Unlicense
* Modernizr: MIT/BSD license
* jQuery: MIT/GPL license
* Bootstrap: Apache 2.0 license

Copyright and license
-----------

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this work except in compliance with the License.
You may obtain a copy of the License in the LICENSE file, or at:

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.