  === Your Site's Functionality Plugin ===
Woocommerce Secial Product Offer plugin developed by martijnwip.nl


INSTALL:
- Add template_add_insurance.php int your themes folder.
- Go to pages and add new page with title "add insurance backend page"
- make sure permalinks are set to Post Name 


//assets needed
- insurance.js
- insurance.css
- template_add_insurance template
- woocommerce plugin


TO ADD SPECIAL PRODUCT :

This plugin was originally developed to offer an insurance for a product in a specific price range

Add a table after the woocommerce shopping cart with a choice to add a protection plan to the cart
Value of the protection plan is calculated by the total value of the shopping cart

1. Add a category 'wcpo' to your categories
2. Add three products with the specs and assign them to the category 'wcpo'. Products will not appear in regular shop.
   For example 'protection care A', 'protection care B', 'protection care C'			
3. Give each product a price range for which the protection plan. See the custom fields underneath the description

For example
A = 0 - 500 
B = 500 - 1500
B = > 1500  (fill in max price of 10.000)



When yoy want to offer only one product

you can misuse the plugin if you want to make a 'special offer'. 
1. Add a category 'wcpo' to your categories
2. Add only one product
3. Give the product a price range which covers all your products. See the custom fields underneath the description
For example 0 to 100.000 


