Magento 2.0 Sample Module
====================

Last tested on Magento2 version 1.0.0-beta5.


![Magento 2 Sample Module](http://i.imgur.com/Ma6v2gs.jpg)

What I got so far:
----------

 - One custom entity Author. flat and related to store views
 - Backend section for the entity mentioned above
 - Frontend list and view for the entity mentioned above
 - Backend relation (many to many) to catalog products. on the edit form there is a tab called 'Products' similar to related products. On the product edit page there is a tab called Authors. 
 - List on Author view page on frontend the related products paginated and with a sorting options.
 - List related authors on product view page. There is a problem with the pagination due to a Magento2 bug [#970](https://github.com/magento/magento2/issues/970)
 - Rss feeds for author list.
 - Breadcrumbs support for list and view pages.
 - Many to many relation with the categories (one category tab on entity add/edit form and one tab with the entities on the category add/edit form)
 - Display related categories in the author page.
 - Display related authors in the category page.


The other types of entities and features listed in **the purpose** will follow.  
Don't put many hopes in this. Based on the comments on the magento 2 repo the grid system will be changed...A LOT.  

The purpose 
----------

....of this repository is to hold a sample CRUD module for Magento 2.0.  
This module should contain the following: 

 * 4 Entities. 
  * 1 Flat - with a store selector. Similar to CMS pages
  * 1 Flat but behaving as a tree - with a store selector. Similar to categories but non EAV
  * 1 EAV - similar to products
  * 1 EAV but behaving as tree - Similar to categories.
 * Backend files for managing the entities mentioned above
 * Frontend files for list and view each of the entities mentioned above
 * RSS feeds for each entity mentioned above
 * SOAP & REST API files for the entities mentioned above
 * URL rewrites filed for frontend for the entities above
 * Files needed for a many to many relation between the entities above and products
 * Files needed for a many to many relation between the entities above and categories
 * Files needed for a many to many relation between the entities above (among themselves)
 * Each entity must support different attribute types:
  * Text
  * Textarea (with and without WYSIWYG editor)
  * Date
  * Yes/No
  * Dropdown (with different source models)
  * Multi-select (with different source models)
  * File
  * Image
  * Decimal
  * Integer
 * Each entity should have fronend links to the list page in one of the menu/link areas provided by the default theme
 * Each entity must have SEO attributes (meta-title, meta-description, meta-keywords)
 * Would be nice to have unit tests for every class in the code - but that's low priority.
 * Each entity type must have widgets for frontend (link, short view).
 * Each entity must support customer comments.
 * Each EAV entity must have a section for managing attributes (similar to product attributes).
 
After this is complete (or almost) it will become the base source for the Ultimate Module Creator 2.0 which will be a version for Magento 2.0 of the [Ultimate Module Creator for Magento 1.7](https://github.com/tzyganu/UMC1.9). 

Any other ideas and pieces of code are welcomed even encouraged.

Install
-----

To install this module copy the code from this repo to `app/code` folder of your Magento 2 instance,  
If you do this after installing Magento 2 you need to run `php bin/magento setup:upgrade`
 
