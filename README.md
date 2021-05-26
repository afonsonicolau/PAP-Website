# Olfaire eCommerce Project
The "__Olfaire eCommerce Project__" is a fully functional eCommerce page where you can buy pottery products. This project also integrates an administrative backoffice/dashboard, with, of course, a home/landing page where the user/client can see all relevant information about the __Olfaire Mendes&Nicolau__ company.
___

## Laravel Framework & Web Developing
This project it's made with the PHP framework "Laravel". The reason I choose Laravel was because of it's intuitive and easy use, compared to other frameworks. Laravel makes it possible to use the __MVC__ concept and develop websites a lot faster than it would be in, for example, pure PHP.

### Permission System with Middleware
Laravel makes it easy to develop a permission system using it's middlware. Middleware it's a group of security levels, you can create your own security level and make users need to do something before they proceed to other steps. What I did with middleware was:

* User needs to be logged in to make most of actions (such as add products to your cart);
* To access the administrative backoffice you need it's role, otherwise it redirects you to an unauthorized page (403 error);
* You must be e-mail verified to access backoffice (if administrator), access your profile and even buy something from the store.

### Pagination and Filters
We can all agree that making a pagination and/or filters from scratch can sometimes be either very boring or difficult, but with Laravel I can just simply use the __links__ method and a pagination will be done. Of course not everything comes with only a good side. Working the store filters with pagination was one of the most difficult things I did in my project, either way, it allows you to do the following:

* Filter product types and collections or even price;
* Paginate through products (20 per page);
* Use both together, intuitively, where you can just filter a product and search it throughout pages.

## Objectives & Goals 

My project consists in making a website for a enterprise in the urgent need of one while learning with everything I do and search while I develop the project. As objetives, I have the following:

- Use the Laravel framework to develop skills so I can better use other frameworks;
- Use Github with Gitbash to keep all the information I need stored;
- Organize myself and the project while making it better and bigger;
