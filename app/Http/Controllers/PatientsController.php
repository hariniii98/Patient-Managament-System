<?php
         
namespace App\Http\Controllers;
          
use App\Models\Patient;
use App\Models\BloodTestParameter;
use Illuminate\Http\Request;
use DataTables;
        
class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $patients = Patient::latest()->get();
        
        if ($request->ajax()) {
            $data = Patient::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPatient">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePatient">Delete</a>';
    
                            return $btn;
                    })->addColumn('add-report', function($row){

                        $btn = ' <a href="/patient-report/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-name="'.$row->name.'" data-original-title="Add/View Report" class="btn btn-warning btn-sm addViewReport">Add/View Reports</a>';
 
                         return $btn;
                    })
                    ->rawColumns(['action','add-report'])
                    ->make(true);
        }

        $data['blood_test_parameters'] = BloodTestParameter::all();
      
        return view('patient',compact('patients'))->with($data);
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Patient::updateOrCreate(['id' => $request->patient_id],
                ['name' => $request->name, 'email' => $request->email, 'age' => $request->age]);        
   
        return response()->json(['success'=>'Patient saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::find($id)->delete();
     
        return response()->json(['success'=>'Patient deleted successfully.']);
    }
}