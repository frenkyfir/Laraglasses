<?php
        namespace App\Http\Controllers\Back\Tbl_frame_category;
        use Illuminate\Http\Request;
        use App\Http\Controllers\Controller;
        use App\Models\Tbl_frame_category;
        use DB;
        use Hash;
        use Illuminate\Support\Arr;

        class Tbl_frame_categoryController extends Controller
        {
            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function index(Request $request)
            {
                $data = Tbl_frame_category::orderBy("id","DESC")->get();
                return view("back.Tbl_frame_category.index",compact("data"))
                    ->with("i", ($request->input("page", 1) - 1) * 5);
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
        
            public function create()
            {
                return view("back.Tbl_frame_category.create");
            }
        
        
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
        
            public function store(Request $request)
            {
               
                    $this->validate($request, ["name" => "required",
"deleted" => "required",
]);
                $input = $request->all();
                
                
                $Tbl_frame_category = Tbl_frame_category::create($input);
               
            
                return redirect()->route("tbl_frame_category.index")
                ->with("success","Tbl_frame_category created successfully");
            
            }
        
        
            /**
                 * Display the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
        
                public function show($id)
                {
                    $Tbl_frame_category = Tbl_frame_category::find($id);
                    return view("back.Tbl_frame_category.show",compact("Tbl_frame_category"));
                }
            

            
                /**
                 * Show the form for editing the specified resource.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function edit($id)
                {
                    $Tbl_frame_category = Tbl_frame_category::find($id);
                    return view("back.Tbl_frame_category.edit",compact("Tbl_frame_category"));
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
                
                   
                        $this->validate($request, ["name" => "required",
"deleted" => "required",
]);
                        

                    $input = $request->all();

                    
                    
                    
                    $Tbl_frame_category = Tbl_frame_category::find($id);
                    $Tbl_frame_category->update($input);
                
                    return redirect()->route("tbl_frame_category.index")
                    ->with("success","Tbl_frame_category updated successfully");
                
                }
            

                /**
                 * Remove the specified resource from storage.
                 *
                 * @param  int  $id
                 * @return \Illuminate\Http\Response
                 */
            
                public function destroy($id)
                {
                    Tbl_frame_category::find($id)->delete();
                    return redirect()->route("tbl_frame_category.index")
                    ->with("success","Tbl_frame_category deleted successfully");
                
                }
            }
        
        ?>