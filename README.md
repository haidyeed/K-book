# K-book

git clone https://github.com/haidyeed/K-book.git

cp .env.example .env
composer install
php artisan key:generate
CREATE DATABASE k_book (via mysql command)
php artisan migrate
php artisan db:seed
php artisan serve

note : all users passwords are set to 12345678
User login : url /api/login any user name or email with password = 12345678

_________________________________________________


Api Documentation : I used Rakutentech package
http://127.0.0.1:8000/request-docs

___________________________________________________

apis :
method: POST
url: http://127.0.0.1:8000/api/register
body: {
    "phone":"01234567890"
    "email":"test@mail.com",
    "password":"12345678",
    "password_confirmation":"12345678",
    "name":"test"
}
response: {
    "success": "Account successfully registered.",
    "user": {
        "name": "test",
        "phone": "01234567890",
        "email": "test@mail.com",
        "updated_at": "2024-03-30T19:21:49.000000Z",
        "created_at": "2024-03-30T19:21:49.000000Z",
        "id": 51
    }
}
_______________
method: POST
url: http://127.0.0.1:8000/api/login
body: {
    "name":"test@mail.com",       //or "test" (name or email field)
    "password":"12345678",
}
response:{
    "success": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YjNkNmVjOC1iMWRmLTQ5NmItODgzYS01ZmQxNDY4ZTg2OWIiLCJqdGkiOiI0MjhmOGQ1MDU4OWUzOGNmM2ZlYjA3MjY1NzVlMjZmNmZmYTQ3ZDUyZTkxNzkyMmYwN2VmMjM3ZTYzOTUzNmE1MjI4MGMwZDg4YjU1YjcwZCIsImlhdCI6MTcwNjk2OTU4MS4yMDU0MTQsIm5iZiI6MTcwNjk2OTU4MS4yMDU0MTYsImV4cCI6MTczODU5MTk4MS4xOTI3NTQsInN1YiI6IjMiLCJzY29wZXMiOltdfQ.fno77o0-Rwztv9sATvGwvSup2yLXPHvLWLAPjzx0s5ipquDKFwVwrKvzOxz3ZXgkcFqNdiAZjyCJbuRJ41LwrCmqZFr64BLmoVfLL915fAH65uTzmqdkA3MroBAthebeb76OtianRUenLnjbmedrqDF3Q7Te8AK0HJjePLhizw7f5x6kCNLDojMrzzPKcMjXrRL_L52qhpSELVrshg8JV0tv6rw_fzdZsyl96J8PcX5IW_68TW4GvGohiTBRXkLkvYpI7A7EekYD85V3Bw1Yt3p2PWZ55jwlIit_EbDE87pYiWOc2hACG0hGNjO0DlQdTFbHbZLH0E7nVE3LzahfaPDuco_oqSd0Fmur3Ei6hP_6VGz0HmsAwTuU3KhzCQLILcSUvG37TG2_Pa71r3cdZSduDpUEYznffMCX7jtCqwxQQBMny2iWYthNq3WfBCLzpkUoxJylbSD4MYtXV7NO1rb__UNd_95WtvRh21ikYO-C5a6Qs6vWPs5CyDIEa4XN_MStWLm_W75RcyNe93qVIA3Gc98jfpoB4h4i5tnGRLuI0argzr58c8j2DVXwteM4YsPmIO6rI27i3bdd8THZM71V3TdYbC5QwRTR5X63igsjWuTOMDx2TXUx2TDvYNZc99JyRD0QFWADn3nhiGOcL3NzfAnrwLnUQsz_xiE5Dv0"
    },
    "user": {
        "id": 51,
        "name": "test",
        "phone": "01234567890",
        "email": "test@mail.com",
        "email_verified_at": null,
        "updated_at": "2024-03-30T19:21:49.000000Z",
        "created_at": "2024-03-30T19:21:49.000000Z"
    }
}
__________________________
notes:

- All apis must be authorized with bearer token coming from auth login api

- All listed responses are in success case response, in case on any error response will be changed accordingly

method: POST
url: http://127.0.0.1:8000/api/books
header: "Authorization: Bearer: eyJ0e.........."
body: {
    "name":"book new name",
    "author":"author name",
    "number_of_pages":20
}
response:{
    "success": true,
    "message": "a new book has been added successfully",
    "data": {
        "name": "book new name",
        "author": "author name",
        "number_of_pages": 20,
        "updated_at": "2024-03-30T20:43:24.000000Z",
        "created_at": "2024-03-30T20:43:24.000000Z",
        "id": 51
    }
}
_________________________________
method: GET
url: http://127.0.0.1:8000/api/books
header: "Authorization: Bearer: eyJ0e.........."
body: 
response: {
    "success": true,
    "message": "a list of all books",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Qui repudiandae.",
                "author": "Wade Langosh",
                "number_of_pages": 4893,
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 2,
                "name": "Voluptatem.",
                "author": "Kianna Jenkins",
                "number_of_pages": 4831,
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 3,
                "name": "Laboriosam et qui.",
                "author": "Adelbert Cole",
                "number_of_pages": 4447,
                "created_at": null,
                "updated_at": null
            }
        ],
        "first_page_url": "http://127.0.0.1:8000/api/books?bookpage=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/books?bookpage=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/books?bookpage=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/books",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
}
___________________
method: DELETE
url: http://127.0.0.1:8000/api/books/1
header: "Authorization: Bearer: eyJ0e.........."
body: 
response: {
    "success": true,
    "message": "book deleted successfully"
}
__________________
method: POST
url: http://127.0.0.1:8000/api/user-reading-intervals
header: "Authorization: Bearer: eyJ0e.........."
body: {
    "user_id":11,
    "book_id":10,
    "start_page":1000,
    "end_page":1202
}
response:{
    "success": true,
    "message": "a new user reading interval has been added successfully",
    "data": {
        "user_id": 11,
        "book_id": 10,
        "start_page": 1000,
        "end_page": 1202,
        "updated_at": "2024-03-30T20:57:53.000000Z",
        "created_at": "2024-03-30T20:57:53.000000Z",
        "id": 51
    }
}
_________________________________
method: GET
url: http://127.0.0.1:8000/api/user-reading-intervals
header: "Authorization: Bearer: eyJ0e.........."
body: 
response: {
    "success": true,
    "message": "a list of all reading intervals",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "user_id": 48,
                "book_id": 23,
                "start_page": 819,
                "end_page": 1009,
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 2,
                "user_id": 48,
                "book_id": 42,
                "start_page": 474,
                "end_page": 3784,
                "created_at": null,
                "updated_at": null
            },
        ],
        "first_page_url": "http://127.0.0.1:8000/api/user-reading-intervals?user-reading-intervalpage=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/api/user-reading-intervals?user-reading-intervalpage=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/user-reading-intervals?user-reading-intervalpage=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/api/user-reading-intervals",
        "per_page": 10,
        "prev_page_url": null,
        "to": 2,
        "total": 2
    }
}
___________________
method: DELETE
url: http://127.0.0.1:8000/api/user-reading-intervals/1
header: "Authorization: Bearer: eyJ0e.........."
body: 
response: {
    "success": true,
    "message": "Reading Interval deleted successfully"
}
__________________
method: GET
url: http://127.0.0.1:8000/api/top-recommended-books
header: "Authorization: Bearer: eyJ0e.........."
body: 
response: {
    "success": true,
    "message": "a list of top recommended 5 books",
    "data": [
        {
            "book_id": 18,
            "book_name": "Aut cupiditate.",
            "num_of_read_pages": 3515
        },
        {
            "book_id": 2,
            "book_name": "Voluptatem.",
            "num_of_read_pages": 3481
        },
        {
            "book_id": 42,
            "book_name": "Ipsa ut dolorem qui.",
            "num_of_read_pages": 3311
        },
        {
            "book_id": 38,
            "book_name": "Beatae sunt sit.",
            "num_of_read_pages": 2444
        },
        {
            "book_id": 9,
            "book_name": "Ad commodi adipisci.",
            "num_of_read_pages": 1972
        }
    ]
}