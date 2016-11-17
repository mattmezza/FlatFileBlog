# FlatFileBlog
Need a blog module for you website? This one's based on flat files

[![Build Status](https://travis-ci.org/mattmezza/FlatFileBlog.svg?branch=master)](https://travis-ci.org/mattmezza/FlatFileBlog) [![Latest Stable Version](https://poser.pugx.org/mattmezza/flat-file-blog/v/stable)](https://packagist.org/packages/mattmezza/flat-file-blog) [![License](https://poser.pugx.org/mattmezza/flat-file-blog/license)](https://packagist.org/packages/mattmezza/flat-file-blog)

-----

`composer require mattmezza/flat-file-blog`

```php

$blog_manager = new BlogManager($url, $posts_dir, $posts_perpage, $pages_dir, $authors);
$page = $blog_manager->get_page("page");
// reads file page.md from dir $pages_dir
// parses yaml initial section into $page->metas
// converts md into html and puts content in $page->body
echo $page->body;

```

Check out `tests/BlogTest.php` for more information.

Matteo Merola <mattmezza@gmail.com>
