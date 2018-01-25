# Bodyless Module Proof of Concept -- BPOC

## Concept
BPOC is a module for Drupal 8, built with a block plugin, that integrates React into the block. This is a proof of
concept module built to test out the viability in taking this approach. The module uses the term 'bodyless' as it relies
on Drupal 8 only as the delivery mechanism for the view. There is not any reliance directly on Drupal 8 from a 'model' or
'controller' perspective.

In this module, there are some configuration settings for using this module as it is, but that is simply by choice, as the
integration of that configuration into React is also testing the viability for passing in Drupal 8 variables to the React app.
 
 
## Installation

Using a console or terminal, go to the root directory of your Drupal 8 installation, and enter in the following command: 
```composer require t73biz/bpoc```

Then once that has finished, run the following command:
```drush en bpoc```

Next, login into your Drupal 8 admin section and go to ```/admin/structure/block```. In here you will click a _Place block_
button that will bring up a menu to allow you to choose a block to place in that selection. Choose _BPOC Block_ by
clicking on the _Place block_ button next to it.  A simple form will be presented to you asking you for the block title,
and _Who_ you want to say hello to. Click the _Save block_ button. This will close the form box, and return you to the
block structure page. Scroll to the bottom of the page, and click the _Save blocks_ button there. Once complete, you can
view your block on the frontend of the site.
 
## Removal

Removing BPOC from your Drupal 8 installation is easy. Use the following commands from the command line:
```drush pmu bpoc``` and ```composer remove t73biz/bpoc```. This will completely remove all of the configuration for BPOC
as well as the block that was inserted.

