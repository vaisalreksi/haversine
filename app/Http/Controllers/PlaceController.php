<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use DB;

class PlaceController extends Controller
{
  public function index(Request $request)
  {
    return view('place.add',['type'=>'place']);
  }

  public function detail($id,$lat,$long)
  {
    $data = Place::find($id);

    if(empty($data)) return view('404');

    switch ($data->type) {
      case '0':
        $video = 'images/detail-wisata.mp4';
        $img = 'images/detail-wisata.jpg';
        $type = 'Tourist Attraction';
        break;
      case '1':
        $video = 'images/detail-hotel.mp4';
        $img = 'images/detail-hotel.png';
        $type = 'Hotel';
        break;
      default:
        $video = 'images/detail-restaurant.mp4';
        $img = 'images/detail-restaurant.jpg';
        $type = 'Restaurant';
        break;
    }

    $json = array(
      'video' => $video,
      'type' => $type,
      'img' => $img,
      'image' => (empty($data->image))?'images/not-found.jpg':'image/'.$data->image,
      'title' => $data->name,
      'distance' => $this->getDistance($lat,$long,$data->latitude,$data->longitude),
      'phone' => $data->phone,
      'address' => $data->address,
      'email' => $data->email,
      'direction' => "https://www.google.com/maps/dir/?api=1&origin=".$lat.",".$long."&destination=".$data->latitude.",".$data->longitude,
      'description' => $data->description,
      'keyword' => $data->keyword,
      'latitude' => $data->latitude,
      'longitude' => $data->longitude,
      'website' => $data->website,
      'facebook' => $data->facebook,
      'twitter' => $data->twitter,
      'youtube' => $data->youtube,
      'recommendation' => $this->getNearestLocation($data->latitude,$data->longitude,$data->type)
    );

    return view('place.detail',['type'=>'detail','data'=>$json]);
  }

  public function getDistance($lat1,$long1,$lat2,$long2)
  {
    $result = 0;
    $data = DB::select('SELECT (6371 * ACOS(COS(RADIANS('.$lat1.')) * COS(RADIANS('.$lat1.')) * COS(RADIANS('.$long2.') - RADIANS('.$long1.')) + SIN(RADIANS('.$lat1.')) * SIN(RADIANS('.$lat1.')))) as distance');
    if(!empty($data)) $result = round($data[0]->distance);

    return $result;
  }

  public function list(Request $request)
  {
    $input = $request->all();

    $lat = (isset($input['lat']) && !empty($input['lat'])) ? $input['lat'] : "-2.275139";
    $long = (isset($input['long']) && !empty($input['long'])) ? $input['long'] : "99.4050643";
    $distance = (isset($input['distance']) && !empty($input['distance'])) ? $input['distance'] : "10";
    $key = (isset($input['key']) && !empty($input['key'])) ? $input['key'] : "";

    $data = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $data = $data->whereRaw('(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) <= '.$distance);
    $data = $data->where('type','>',0);
    $data = $data->orderBy('distance','ASC');
    $data = $data->get();
    $json = [];
    if(!$data->isEmpty()){
      foreach ($data as $value) {
        switch ($value->type) {
          case '0':
            $img = 'images/wisata.jpg';
            $type = 'Tourist Attraction';
            break;
          case '1':
            $img = 'images/hotel.png';
            $type = 'Hotel';
            break;
          default:
            $img = 'images/restaurant.png';
            $type = 'Restaurant';
            break;
        }

        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => substr($value->description,0,100),
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'type' => $type,
          'keyword' => $value->keyword
        );
      }
    }

    return view('place.list',['type'=>'list','data'=>$json,'key'=>$key,'distance'=>$distance]);
  }

  public function search(Request $request)
  {
    $input = $request->all();

    $lat = (isset($input['lat']) && !empty($input['lat'])) ? $input['lat'] : "-2.275139";
    $long = (isset($input['long']) && !empty($input['long'])) ? $input['long'] : "99.4050643";
    $distance = (isset($input['distance']) && !empty($input['distance'])) ? $input['distance'] : "10";

    $data = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $data = $data->whereRaw('(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) <= '.$distance);
    if(isset($input['key']) && !empty($input['key'])){
      $data = $data->where('keyword','LIKE','%'.$input['key'].'%');
    }
    $data = $data->where('type',0);
    $data = $data->get();
    $json = [];
    if(!$data->isEmpty()){
      foreach ($data as $value) {
        switch ($value->type) {
          case '0':
            $img = 'images/wisata.jpg';
            break;
          case '1':
            $img = 'images/hotel.png';
            break;
          default:
            $img = 'images/restaurant.png';
            break;
        }

        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => $value->keyword,
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'type' => $value->type
        );
      }
    }

    return json_encode($json);
  }

  public function add(Request $request)
  {
    $input = $request->all();

    $image = null;
    if(isset($input['file']) && !empty($input['file'])){
      $getimageName = time().'.'.$request->file->getClientOriginalExtension();
      $request->file->move(public_path('image'), $getimageName);
      $image = $getimageName;
    }

    $model = new Place;
    $model->type = $input['type'];
    $model->name = $input['name'];
    $model->keyword = strtolower($input['keyword']);
    $model->address = $input['address'];
    $model->website = $input['website'];
    $model->phone = $input['phone'];
    $model->email = $input['email'];
    $model->description = $input['description'];
    $model->latitude = $input['latitude'];
    $model->longitude = $input['longitude'];
    $model->image = $image;
    $model->facebook = $input['facebook'];
    $model->twitter = $input['twitter'];
    $model->youtube = $input['youtube'];
    $model->instagram = $input['instagram'];
    $model->whatsapp = $input['whatsapp'];
    $model->save();

    return redirect('/');
  }

  public function getNearest(Request $request)
  {
    $input = $request->all();

    $lat = (isset($input['lat']) && !empty($input['lat'])) ? $input['lat'] : "-2.275139";
    $long = (isset($input['long']) && !empty($input['long'])) ? $input['long'] : "99.4050643";
    $json = [];

    $dataHotel = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $dataHotel = $dataHotel->where('type',1);
    $dataHotel = $dataHotel->orderBy('distance','ASC');
    $dataHotel = $dataHotel->limit(10);
    $dataHotel = $dataHotel->get();

    if(!$dataHotel->isEmpty()){
      foreach ($dataHotel as $value) {
        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => substr($value->description,0,100),
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'type' => 'Hotel',
          'keyword' => $value->keyword
        );
      }
    }

    $dataRest = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $dataRest = $dataRest->where('type',2);
    $dataRest = $dataRest->orderBy('distance','ASC');
    $dataRest = $dataRest->limit(10);
    $dataRest = $dataRest->get();

    if(!$dataRest->isEmpty()){
      foreach ($dataRest as $value) {
        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => substr($value->description,0,100),
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'type' => 'Restaurant',
          'keyword' => $value->keyword
        );
      }
    }

    return json_encode($json);

  }

  public function getNearestLocation($lat,$long,$type)
  {

    $json = [];

    if($type > 0){
      $dataWisata = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
      $dataWisata = $dataWisata->where('type',0);
      $dataWisata = $dataWisata->orderBy('distance','ASC');
      $dataWisata = $dataWisata->limit(5);
      $dataWisata = $dataWisata->get();

      if(!$dataWisata->isEmpty()){
        foreach ($dataWisata as $value) {
          $json[] = array(
            'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
            'title' => $value->name,
            'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
            'desc' => substr($value->description,0,100),
            'address' => $value->address,
            'phone' => $value->phone,
            'rating' => 4,
            'view' => round($value->distance),
            'lat' => $value->latitude,
            'long' => $value->longitude,
            'distance' => $value->distance,
            'type' => 'Tourist Attraction',
            'keyword' => $value->keyword
          );
        }
      }
    }

    $dataHotel = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $dataHotel = $dataHotel->where('type',1);
    $dataHotel = $dataHotel->orderBy('distance','ASC');
    $dataHotel = $dataHotel->limit(5);
    $dataHotel = $dataHotel->get();

    if(!$dataHotel->isEmpty()){
      foreach ($dataHotel as $value) {
        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => substr($value->description,0,100),
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'distance' => $value->distance,
          'type' => 'Hotel',
          'keyword' => $value->keyword
        );
      }
    }

    $dataRest = Place::selectRaw('*,(6371 * ACOS(COS(RADIANS(latitude)) * COS(RADIANS('.$lat.')) * COS(RADIANS(longitude) - RADIANS('.$long.')) + SIN(RADIANS(latitude)) * SIN(RADIANS('.$lat.')))) as distance');
    $dataRest = $dataRest->where('type',2);
    $dataRest = $dataRest->orderBy('distance','ASC');
    $dataRest = $dataRest->limit(5);
    $dataRest = $dataRest->get();

    if(!$dataRest->isEmpty()){
      foreach ($dataRest as $value) {
        $json[] = array(
          'link' => 'location-detail/'.$value->id.'/lat/'.$lat.'/long/'.$long,
          'title' => $value->name,
          'image' => (empty($value->image))?'images/not-found.jpg':'image/'.$value->image,
          'desc' => substr($value->description,0,100),
          'address' => $value->address,
          'phone' => $value->phone,
          'rating' => 4,
          'view' => round($value->distance),
          'lat' => $value->latitude,
          'long' => $value->longitude,
          'distance' => $value->distance,
          'type' => 'Restaurant',
          'keyword' => $value->keyword
        );
      }
    }

    return $json;

  }
}
