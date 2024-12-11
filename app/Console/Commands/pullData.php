<?php

namespace App\Console\Commands;

use App\Models\Income;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class pullData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = "http://89.108.115.241:6969/api/";
        $key = "E6kUTYrYwZq2tN4QEtyzsbEBk3ie";
        $limit = 500;
        $page = 1;

        $routes = [
            'incomes' => [
                'dateFrom' => '2000-10-10',
                'dateTo' => '2024-11-11'
            ],
            'stocks' => [
                'dateFrom' => '2000-10-10',
                'dateTo' => '2024-11-11'
            ],
            'sales' => [
                'dateFrom' => '2000-10-10',
                'dateTo' => '2024-11-11'
            ],
            'orders' => [
                'dateFrom' => '2000-10-10',
                'dateTo' => '2024-11-11']
        ];


        foreach ($routes as $route => $date) {
            $this->pullData($baseUrl, $key, $date['dateFrom'], $date['dateTo'], $limit, $route, $page);
            dd('Первый цикл все');
        }

    }

    public function pullData($baseUrl, $key, $dateFrom, $dateTo, $limit, $route, $page)
    {
        $route = 'incomes';
        $currentUrl = $baseUrl . $route . '?';


        $response = Http::get($currentUrl, [
            'key' => $key,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'page' => $page,
            'limit' => $limit,
        ]);
        $data = $response->json()['data']; // ['data'] - для первого метода
        dump($data);
//        foreach ($data as $item) {
//            dump($item);
//        }
        if ($response->json()['meta']['last_page'] > $page++) {
            $this->pullData($baseUrl, $key, $dateFrom, $dateTo, $limit, $route, $page);
        }
        dd("Конец");

    }
}
