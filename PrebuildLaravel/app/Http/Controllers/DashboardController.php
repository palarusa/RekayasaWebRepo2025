<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        //return view('dashboard.index', []);

        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $headers = [
            "Authorization: Basic {$credentials}",
            "Content-Type: application/x-www-form-urlencoded",
            "Cache-Control: no-cache",
        ];

        //default
        $data = [];

        // Initializing curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://127.0.0.2:8001/buku');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Executing curl
        $response = curl_exec($curl);

        // Check for curl errors
        if ($e = curl_errno($curl)) {
            echo $e;
        } else {
            // Decoding JSON data
            $decodedData = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
            //Outputting JSON data in decoded form
            //bar_dump($decodedData);
            $data = $decodedData;
            }
        }

        // Closing curl
        curl_close($curl);


        // Return view dan pass data ke view (sesuaikan nama view jika perlu)
        return view('dashboard.index', [
            'data' => $data, 
            'title' => $title
        ]);
    }
    public function create()
    {
        return view('dashboard.create', ['title' => 'Tambah Buku']);
    }

    public function store(Request $request)
    {
        // Implementasi create data via API
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://127.0.0.1:8001/buku',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic {$credentials}",
                "Content-Type: application/json",
            ],
            CURLOPT_POSTFIELDS => json_encode($request->all()),
            CURLOPT_RETURNTRANSFER => true,
        ]);

        curl_exec($curl);
        curl_close($curl);

        return redirect()->route('dashboardindex')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Implementasi ambil data via API untuk edit
        return view('dashboard.edit', ['title' => 'Edit Buku', 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Implementasi update data via API
        return redirect()->route('dashboardindex')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        // Implementasi delete data via API
        $username = 'user';
        $password = 'user';
        $credentials = base64_encode("$username:$password");

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://127.0.0.1:8001/buku/{$id}",
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => ["Authorization: Basic {$credentials}"],
            CURLOPT_RETURNTRANSFER => true,
        ]);

        curl_exec($curl);
        curl_close($curl);

        return redirect()->route('dashboardindex')->with('success', 'Data berhasil dihapus');
    }

}