<?php

namespace App\Http\Controllers;

use App\Dictionary;
use Illuminate\Http\Request;

class TableDataController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('search') == null){
            $highlightColumn = '';
            $searchText = '';
            $dictionaries = Dictionary::has('terms')->with([
                'terms' => function ($item) {
                    $item->has('translations')->with('translations')->get();
                }])->get()->toArray();

            return view('welcome',compact('dictionaries','highlightColumn','searchText'));
        }else{

            $searchText = $request->input('search');

            $dictionaries = Dictionary::where('name','like','%' . $searchText . '%')->has('terms')->with([
                'terms' => function ($item) {
                    $item->has('translations')->with('translations')->get();
                }])->get()->toArray();

            if (count($dictionaries) == 0){
                $dictionaries = Dictionary::has('terms')->with([
                    'terms' => function ($item) use ($searchText) {
                        $item->where('name','like','%' . $searchText . '%')->has('translations')->with('translations')->get();
                    }])->get()->toArray();

                foreach ($dictionaries as $key => $dictionary){
                    if(count($dictionary['terms']) == 0){
                        unset($dictionaries[$key]);
                    }
                }

                $highlightColumn = 'term';
            }else{
                $highlightColumn = 'dictionary';
            }

            if (count($dictionaries) == 0){
                $dictionaries = Dictionary::has('terms')->with([
                    'terms' => function ($item) use ($searchText) {
                        $item->has('translations')->with([
                            'translations' => function ($translation) use ($searchText) {
                                $translation->where('name','like','%' . $searchText . '%')->get();
                            }])->get();
                    }])->get()->toArray();

                foreach ($dictionaries as $key => &$dictionary){
                    foreach ($dictionary['terms'] as $key => $term){
                        if(count($term['translations']) == 0){
                            unset($dictionary['terms'][$key]);
                        }
                    }
                }

                $highlightColumn = 'translation';
            }

            foreach ($dictionaries as $key => $dictionary){
                if(count($dictionary['terms']) == 0){
                    unset($dictionaries[$key]);
                }
            }

            return view('welcome',compact('dictionaries','highlightColumn','searchText'));
        }

    }
}
