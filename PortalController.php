<?php

class PortalController extends BaseController {
 
    // Constructing default values
    public function __construct() {
     

    }   

    public function search()
    {	
        $data= Input::all();
                 
        $query = $data['query']; 

        //this is where magic happerns, change it to fit your needs.         		
        $output = DB::table('users')->where('users', 'LIKE', '%'.$query.'%')->get();

        return Response::json(['result'   => $output]); 
    }