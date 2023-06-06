# ![WebApp](http://103.214.229.82/landing_page.png)
# Audit Mutu Internal Politeknik Negeri Semarang
<table>
<tr>
<td>
  A webapp using Quandl API to display history of stock growth in a given period of time. It helps predict the growth of stocks from the  charts of stock performace in any period of time. It helps to judge stocks, with the principle of momentum investing, which returns 1% per month on average.
</td>
</tr>
</table>


## Demo
Here is a working live demo :  http://103.214.229.82/


## Site

### Landing Page

![](http://103.214.229.82/landing_page.png)

### Query Filled Form
![](http://103.214.229.82/pengisiandata.png)

### Charts
![](http://103.214.229.82/chart.png)
![](http://103.214.229.82/chart2.png)
![](https://iharsh234.github.io/WebApp/images/demo/demo_chart3.JPG)


## [Usage](https://iharsh234.github.io/WebApp/) 

### Development
================================================================================
Prerequisites:
================================================================================

- Ubuntu 22.04 LTS virtual machine up and running
- Laravel 8.83.23 application up and running
- PHP >= 7.3.28 or 8.0 installed
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- Apache/2.4.47 (Win64) OpenSSL/1.1.1k
- MariaDB 10.4.18

================================================================================
Plugin laravel
================================================================================

- barryvdh/laravel-dompdf": "^0.9.0"
- fideloper/proxy": "^4.4"
- fruitcake/laravel-cors": "^2.0"
- guzzlehttp/guzzle": "^7.0.1"
- laravel/framework": "^8.40"
- laravel/tinker": "^2.5"
- laravel/ui": "^3.3"
- maatwebsite/excel": "^3.1"
- phpoffice/phpword": "^0.18.2"
- sarfraznawaz2005/backupmanager": "^1.4"
- spatie/laravel-backup": "*"
- unisharp/laravel-filemanager": "^2.2"

================================================================================
Installation
================================================================================

    1. Cloningkan app ini dari Gitlab/Github.
        Gitlab/Github:
            'git clone https://gitlab.com/mzsusilo/ami.git'.
            'git clone https://github.com/mzsusilo/ami.git'.

    2. Kemudian menggunakan command line di dalam folder app. Ketikkan composer install.
        edit .env sesuai dengan database Anda.

    3. Update Composer
        composer update || composer install

    4. Import Sql ke database Anda.
        php artisan migrate:refresh --seed

    5. Jalankan perintah "php artisan serve"

    Demo
        ~~~~ Comming Soon ~~~~

================================================================================
Want to contribute? Great!
================================================================================

To fix a bug or enhance an existing module, follow these steps:

- Fork the repo
- Create a new branch (`git checkout -b improve-feature`)
- Make the appropriate changes in the files
- Add changes to reflect the changes made
- Commit your changes (`git commit -am 'Improve feature'`)
- Push to the branch (`git push origin improve-feature`)
- Create a Pull Request 

### Bug / Feature Request

If you find a bug (the website couldn't handle the query and / or gave undesired results), kindly open an issue [here](https://github.com/iharsh234/WebApp/issues/new) by including your search query and the expected result.

If you'd like to request a new function, feel free to do so by opening an issue [here](https://github.com/iharsh234/WebApp/issues/new). Please include sample queries and their corresponding results.


## [License](http://103.214.229.82/LICENSE.md)

MIT © [AMI](http://103.214.229.82/)

