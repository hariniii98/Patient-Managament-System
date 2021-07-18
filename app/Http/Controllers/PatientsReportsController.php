<?php
         
namespace App\Http\Controllers;
          
use App\Models\Patient;
use App\Models\PatientsBloodTestReport;
use App\Models\BloodTestParameter;
use Illuminate\Http\Request;
use DataTables;
        
class PatientsReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id){
        
        $data['patient_all_reports'] = PatientsBloodTestReport::where('patient_id',$id)->get();
        $data['records_count'] = PatientsBloodTestReport::where('patient_id',$id)->count();
        $data['last_1'] = PatientsBloodTestReport::where('patient_id',$id)->latest()->first();
        $data['last_2'] = PatientsBloodTestReport::where('patient_id',$id)->orderBy('created_at', 'desc')->latest()->skip(1)->take(1)->first();
        $data['patient_id'] = $id;
        $data['patient'] = Patient::find($id);
        $data['blood_test_parameters'] = BloodTestParameter::all();
        $data['glucose'] = BloodTestParameter::find(1);
        $data['insulin_fasting'] = BloodTestParameter::find(2);
        $data['albumin'] = BloodTestParameter::find(3);
        $data['calcium'] = BloodTestParameter::find(4);
        return view('patient_reports')->with($data);
    }

    public function store(Request $request){
        $report = new PatientsBloodTestReport();
        $report -> patient_id = $request->patient_id;
        $report -> glucose = $request->glucose;
        $report -> insulin_fasting = $request->insulin_fasting;
        $report -> albumin = $request->albumin;
        $report -> calcium = $request->calcium;
        $report->save();
        return response()->json(['success'=>'Patient report added successfully.']);
    }

    public function update(Request $request,$id){
        $report = PatientsBloodTestReport::find($id);
        $report -> glucose = $request->glucose;
        $report -> insulin_fasting = $request->insulin_fasting;
        $report -> albumin = $request->albumin;
        $report -> calcium = $request->calcium;
        $report->update();
    }
}