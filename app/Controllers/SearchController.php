<?php namespace App\Controllers;

use CodeIgniter\Controller;

class SearchController extends Controller
{
    public function index()
    {
        return view('dashboard/index'); 
    }

    public function search()
    {
        $query = $this->request->getPost('query');
        $apiKey = '44245199-8b158c23d346512de7825a7e7'; 
        $url = "https://pixabay.com/api/?key=$apiKey&q=" . urlencode($query) . "&image_type=photo&per_page=20";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        $results = $data['hits'] ?? [];

        $html = '';
        if (!empty($results)) {
            foreach ($results as $result) {
                $html .= '<div class="col-md-4 result-item">';
                $html .= '<img src="' . esc($result['webformatURL']) . '" alt="Image">';
                $html .= '<p class="text-center">' . esc($result['tags']) . '</p>';
                $html .= '</div>';
            }
        } else {
            $html .= '<p class="text-center">No results found.</p>';
        }

        return $this->response->setBody($html);
    }
}
