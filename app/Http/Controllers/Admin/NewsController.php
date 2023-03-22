<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Post,
    Category,
    Pseudonym
};

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('pseudonym','categories')
                            ->orderBy('id','desc')
                            ->where('type','news')
                            ->get();
        return view('admin.news.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $curl_connection = curl_init();

        // curl_setopt($curl_connection, CURLOPT_URL, 'http://api.mediastack.com/v1/news?access_key=b11929eb6e6ba9981273a5fb5dbeec6b&countries=au');
        curl_setopt($curl_connection, CURLOPT_URL, 'https://newsapi.org/v2/everything?q=Apple&from=2021-06-09&sortBy=popularity&apiKey=4ebbaa14114e44c4aca58c899586c228');
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);

        $json_response = curl_exec($curl_connection);
        curl_close($curl_connection);
        $response = json_decode($json_response);
        // dd($response->articles);
        if(isset($response->articles) && count($response->articles)){
            foreach($response->articles as $p){
                Post::saveNews($p);
                // $post->saveNews($response->articles);
            }
        }
        return redirect()->route('admin.news.index')->with('success','News imported successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetchNews($channel)
    {
        if($channel=='bol-news'){
            $url = 'https://www.bolnews.com/feed/';

        }elseif($channel=='ary-news'){
            $url = 'https://arynews.tv/en/feed/';

        }else{
            return redirect()->route('admin.news.index')->with('error','Failed to import news, No channel found');
        }
        $newsoutput = new \SimpleXMLElement($url, LIBXML_NOCDATA, true);
        $newsoutput = json_decode(json_encode($newsoutput), TRUE);
        if(isset($newsoutput) && isset($newsoutput['channel']) && isset($newsoutput['channel']['item'])){
            foreach($newsoutput['channel']['item'] as $p){
                $p['channel'] = $channel;
                Post::saveFetchNews($p);
            }
        }
        return redirect()->route('admin.news.index')->with('success','News imported successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['heading_title'] = "Edit";
        $data['categories'] = Category::where('is_active',1)->where('parent_id',0)->orderBy('id','desc')->get();
        $data['pseudonyms'] = Pseudonym::orderBy('id','desc')->get();
        $data['mediagalleries'] = MediaGallery::where('type','image')->orderBy('id','desc')->take(10)->get();
        $data['post'] = Post::with('categories','pseudonym')->find($id);
        return view('admin.posts.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // b11929eb6e6ba9981273a5fb5dbeec6b
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function getNews()
    {
        // $queryString = http_build_query([
        //   'access_key' => 'b11929eb6e6ba9981273a5fb5dbeec6b',
        //   'keywords' => 'Wall street -wolf', // the word "wolf" will be
        //   'categories' => '-entertainment',
        //   'sort' => 'popularity',
        // ]);

        // $ch = curl_init(sprintf('%s?%s', 'http://api.mediastack.com/v1/', $queryString));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $json = curl_exec($ch);

        // curl_close($ch);

        // $apiResult = json_decode($json, true);

        // print_r($apiResult);


        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, 'http://api.mediastack.com/v1/news?access_key=b11929eb6e6ba9981273a5fb5dbeec6b&countries=au');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $phoneList = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        $jsonArrayResponse = json_decode($phoneList);
        if(isset($jsonArrayResponse->data) && count($jsonArrayResponse->data)){
            foreach($jsonArrayResponse->data as $p){
                $post = new Post;
                $post->saveNews($p);
            }
        }
        return redirect()->route('admin.news.index')->with('success','News imported successfully');
    }
}
