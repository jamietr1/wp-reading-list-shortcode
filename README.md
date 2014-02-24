wp-reading-list-shortcode
=========================

A shortcode for WordPress that parses a text file reading list into a nicely formatted page.

This code will create a shortcode called [ReadingList] that can be embedded anywhere in a WordPress site and which will produce a nicely formatted list based on a simple text file stored on Dropbox. For an example of what the list looks like in WordPress, see: http://www.jamierubin.net/misc/reading-list-since-1996/

# Requirements

1. The source reading list must be stored in a text file using a specific, but simple format (see Reading List Format below).
2. The source text file must be stored in a publicly accessible URL. I store my reading.txt file on Dropbox and use the URL from dropbox.
3. The code in functions.php needs to be added to your functions.php file in the appropriate place. Note that I use a child theme, so that the entire functions.php is included as part of my child theme and automatically appended to the main functions.php. This way, if the parent theme ever changes, my child theme changes don't get blown away. I recommend this as the cleanest way of using this function.

# Reading List Format

The reading list file should be in the following format:

Title by Author (mm/dd/yyyy)

where any of the following symbols can be appended to the title:

* * = favorite
* @ = audio book
* + = e-book
* ^ = repeat reading

Each line in the file contains one book, for instance:

    John Adams^*@ by David McCullough (2/20/2014)

In the above example, the ^\*@ indicates that this was not the first time I read the book (^), that I recommend the book (*) and that this particular reading was an audio-book (@).

If you vary from this formatting, the way the list is displayed in WordPress may have unexpected results, unless you update the code that parses the list.

# How to use the shortcode

1. Add the get\_reading\_list() function to your functions.php file, or better yet, create a child theme and copy the entire functions.php into your child theme.
2. Modify the line that reads:
    $handle = fopen('\<DROPBOX URL TO FILE GOES HERE\>', "rb");
   to include the URL to your reading list text file.
3. To use the shortcode, enter [ReadingList] anywhere in WordPress (pages, posts, widgets) and the shortcode will expand the full list.

