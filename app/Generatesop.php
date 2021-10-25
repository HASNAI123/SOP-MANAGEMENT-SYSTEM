<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\http\request;

use Illuminate\Database\Eloquent\SoftDeletes;


class Generatesop extends Model 
{
    
    use SoftDeletes;
  
    
        protected $table = 'generatesops';
    
        public const STATUS_SELECT = [
            'Pending' => 'Pending',
            'Accepted'   => 'Accepted',
            'Declined'   => 'Declined',
        ];
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        protected $casts=[
          
            'steps'=>'array',
            'desc'=>'array',

        ];
        
        protected $fillable = [
            'sop_title',
            'business_unit',
           'approved_by',
            'uploaded_by',
            'created_at',
            'status',
            'updated_at',
            'deleted_at',
            'Sop_file',
            'effective_date',
            'version_no',
            'doc_no',
            // SOP details content
            'policy',
            'purpose',
            'scope',
            'review_pro',
            'monitoring',
            'verification',
            'steps',
            'desc',
            'img',
            'appendix',
            'folder',
            'Process_owner',
            'Process_exec',


            
        ];
    
        
       
    
    
    }
    

