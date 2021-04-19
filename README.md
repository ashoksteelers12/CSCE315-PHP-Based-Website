# PHP-Based-Website

A website framework developed from PHP code with easily configurable content using plain text data files, and interactive features. This was completed as a project for CSCE 315 in Fall 2020. 

## Table of Contents

- [About](#about)
  - [CSV Parser](#csv-parser)
  - [Wikitext Processor](#wikitext-parser)
  - [Interactive Gallery](#interactive-gallery)
  - [Search](#search)
- [Usage](#usage)
- [View Website](#view-website)

## About

### CSV Parser

The CSV parser is located in proc_csv.php. The parser takes the type of delimeter, type of quote, the file name, and the amount of desired columns as input to display in order to parse CSV files for displaying in a webpage. 

### Wikitext Processor

The Wikitext processor is located in proc_wikitext.php. The processor takes a Wikitext file and performs the conversion to HTML to display on a webpage. These are the conversions that the processor supports:

- Italics/Bold
- Text Highlighting/Coloring
- Images
- Links
- Headings
- Horizontal Rule
- Indentation/Line Breaks
- Blockquotes
- Unordered Lists/Ordered Lists (Up to level 7)
- Description Lists

### Interactive Gallery

The interactive gallery is located in proc_gallery.php. The gallary function takes a CSV file with images (image links), the mode, and the sort mode to display a desired gallery in any webpage. The various modes are: 

- Matrix 
- Details (Lists out image details)
- List

The sorting options are:

- Newest/Oldest
- Largest/Smallest
- Random/Original (How it was in CSV)

### Search

The search is located in search.php. It uses action.php for assistance in outputting the search keyword. The search allows one to be able to search for desired keywords throughout a website. It requires the input of the url for the particular page wanting to search on and the keyword. Warning: There are a few bugs in the search function involving regex, which does not allow it to completely work in extremely complex pages.

## Usage

Running proc_csv.php: 
```
include 'proc_csv.php';
proc_csv("experience.csv",",","\"","ALL");
```


Running proc_wikitext.php: 
```
include 'proc_csv.php';
proc_wikitext("test.wiki");
```


Running proc_gallery.php: 
```
include 'proc_gallery.php';
proc_gallery("gallery_test.csv", "list", "orig");
```

###### View Website

http://ashok-meyyappan.42web.io/
