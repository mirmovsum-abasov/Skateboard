<h1>İstifadə üçün təlimat</h1>
<hr>
ENV faylından bazanı quraşdırdıqdan sonra atılacaq addımlar:
<ul>
    <li>php artisan migrate</li>
    <li>php artisan passport:install</li>
    <li>php artisan db:seed --class=Products</li>
    <li>php artisan db:seed --class=Users</li>
    <li>php artisan serve</li>
</ul>
<hr>
<p>
<b>Test üçün yaradılmış istifadəçidən istifadə edə bilərsiniz.</b>

login : test@test.com

password : 1234
</p>
<hr>

```yaml

POST: 127.0.0.1:8000/api/auth/login

{
    "email": "test@test.com",
    "password": "1234"
}

GET: 127.0.0.1:8000/api/product

-----------------
POST: 127.0.0.1:8000/api/order
{
    "product_id": 1,
    "color_id": 1,
    "amount": 4,
    "email": null,
    "phone": "+994997212120",
    "addr": "Baki Hesen Seyidbeyli"
}
-----------------
GET: 127.0.0.1:8000/api/seller
-----------------
PUT: 127.0.0.1:8000/api/seller/update/1
{
    "delivery_date": "2021-02-02 23:22:02",
    "preparation_date": "2021-02-04 20:22:02"
}
