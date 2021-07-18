<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
 
class PatientsBloodTestReport extends Model
{
    protected $table = "patients_blood_test_reports";
    protected $fillable = [
        'patient_id', 'glucose','insulin_fasting','albumin','calcium'
    ];
}