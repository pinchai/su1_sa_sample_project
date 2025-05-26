#### SU1_SA_PROJECT
#####API
- Laravel 11.x
- Mysql
- JWT
- Notification (Telegram bot)
- Github
````
1. branch
    - id (pk)
    - name*
    - phone*
    - location*
    - description
````
````
2. user
    - id (pk)
    - username*
    - password*
````
````
3. category
    - id (pk)
    - name*
    - description
````

````
4. product
    - id(pk)
    - name*
    - category_id*
    - cost*
    - price*
````
````
5. Customer
    - id(pk)
    - name*
    - description
````
```
6. Invoice
    - id(pk)
    - created_at*
    - created_by*
    - customer_id*
    - total*
```
````
7. invoice_item
    - id (pk)
    - product_id*
    - invoice_id*
    - qty*
    - price
````


# su1_sa_sample_project
