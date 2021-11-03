<?php
/**
 * NodCMS
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

namespace NodCMS\Blog\Models;

use NodCMS\Core\Models\Model;

class BlogComments extends Model
{
    public function init()
    {
        $table_name = "blog_comments";
        $primary_key = "comment_id";
        $fields = array(
            'comment_id'=>"int(11) UNSIGNED NOT NULL AUTO_INCREMENT",
            'session_id'=>"varchar(255) NULL DEFAULT NULL",
            'reply_to'=>"int(11) UNSIGNED NOT NULL DEFAULT '0'",
            'admin_side'=>"int(1) UNSIGNED NOT NULL DEFAULT '0'",
            'post_id'=>"int(11) UNSIGNED NOT NULL DEFAULT '0'",
            'user_id'=>"int(11) UNSIGNED NOT NULL DEFAULT '0'",
            'language_id'=>"int(11) UNSIGNED NOT NULL DEFAULT '0'",
            'comment_name'=>"varchar(255) NULL DEFAULT NULL",
            'comment_email'=>"varchar(255) NULL DEFAULT NULL",
            'comment_notification'=>"int(1) NOT NULL DEFAULT '0'",
            'comment_content'=>"text NULL DEFAULT NULL",
            'created_date'=>"int(11) UNSIGNED NOT NULL DEFAULT '0'",
            'comment_read'=>"int(1) UNSIGNED NOT NULL DEFAULT '0'",
        );
        $foreign_tables = null;
        $translation_fields = null;
        parent::setup($table_name, $primary_key, $fields, $foreign_tables, $translation_fields);
    }
}