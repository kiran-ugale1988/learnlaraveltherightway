<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController
{
    public function index(Request $request): string  
    {
        echo $request->headers->get('X-Request-Id') ."<br/>";
        return 'Transaction page';
    }

    public function show(int $transactionId)
    {
        return 'This is transanction id: '. $transactionId;
    }

    public function create()
    {
        return 'This is transanction create page';
    }

    public function store(Request $request)
    {
        return 'This is transanction store page';
    }

    public function documents()
    {
        return 'Transaction documents';
    }

}
