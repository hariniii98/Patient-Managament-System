<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
 
class BloodTestParameter extends Model
{
    protected $table = "blood_test_parameters";
    protected $fillable = [
        'name', 'min_ref_range','max_ref_range','units_of_measurement'
    ];
}