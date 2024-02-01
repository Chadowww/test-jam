<?php

return [
    '' => ['BookController', 'getBookList',],
    'book/delete/:id' => ['BookController', 'deleteBook', ['id']],
    'book/get-details/:id' => ['BookController', 'getDetailsBook', ['id']],
];
