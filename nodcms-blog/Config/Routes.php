<?php
/**
 * \NodCMS
 *
 *  Copyright (c) 2015-2021.
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 *  @author     Mojtaba Khodakhah
 *  @copyright  2015-2021 Mojtaba Khodakhah
 *  @license    https://opensource.org/licenses/MIT	MIT License
 *  @link       https://nodcms.com
 *  @since      Version 3.2.0
 *  @filesource
 *
 */

if(!isset($routes)) throw new \Exception('$routes not defined.');

$routes->match(['post', 'get'], 'admin-blog/(.+)', "\NodCMS\Blog\Controllers\BlogAdmin::$1");
$routes->get('{locale}/blog', '\NodCMS\Blog\Controllers\Blog::posts');
$routes->get('{locale}/blog/([0-9]+)', '\NodCMS\Blog\Controllers\Blog::posts/$1');
$routes->get('{locale}/blog-post-([0-9]+)', '\NodCMS\Blog\Controllers\Blog::post/$1');
$routes->match(['post', 'get'], '{locale}/blog-comment-([0-9]+)', '\NodCMS\Blog\Controllers\Blog::comment/$1');
$routes->match(['post', 'get'], '{locale}/blog-comment-([0-9]+)-([0-9]+)', '\NodCMS\Blog\Controllers\Blog::comment/$1/$2');
$routes->get('{locale}/blog-cat-([0-9]+)', '\NodCMS\Blog\Controllers\Blog::posts/1/$1');
$routes->get('{locale}/blog-cat-([0-9]+)/([0-9]+)', '\NodCMS\Blog\Controllers\Blog::posts/$1/$3');
