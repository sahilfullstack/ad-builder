<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use FFMpeg;

class ValidComponents implements Rule
{
    protected $type;
    protected $ruleKey;
    protected $ruleValue;
    protected $index;

    protected $ruleBook = [
        'text' => [
            'min_length' => ":attribute must be greater than :ruleValue",
            'max_length' => ":attribute must be less than :ruleValue"
        ],
        'image' => [
            'height'  => 'Height of :attribute must be :ruleValue px',
            'width'   => 'Width of :attribute must be :ruleValue px',
            'invalid' => 'Image link is not valid',
        ],
        'images' => [
            'height'  => 'Height of :attribute image at #:key must be :ruleValue px',
            'width'   => 'Width of :attribute image at #:key must be :ruleValue px',
            'invalid' => 'All the images link must be valid',
        ],
        'photogallery' => [
            'height'  => 'Height of :attribute image at #:key must be :ruleValue px',
            'width'   => 'Width of :attribute image at #:key must be :ruleValue px',
            'invalid' => 'All the links in Photo Gallery must be valid.',
        ],
        'video' => [
            'height'       => 'Height of :attribute must be :ruleValue px',
            'width'        => 'Width of :attribute must be :ruleValue px',
            'max_duration' => 'Maximum duration of :attribute must be :ruleValue',            
            'min_duration' => 'Minimum duration of :attribute must be :ruleValue',  
            'invalid'      => 'Video link is not valid',          
        ]
    ];
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type, $ruleKey, $ruleValue)
    {
        $this->type = $type;
        $this->ruleKey = $ruleKey;
        $this->ruleValue = $ruleValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        switch ($this->type) {
            case 'text':
               return $this->validateText($attribute, $value);
                break;

            case 'image':
                return $this->validateImage($attribute, $value);
                break;

            case 'video':
                return $this->validateVideo($attribute, $value);
                break;

            case 'images':
                return $this->validateImages($attribute, $value);
                break;

            case 'photogallery':
                return $this->validatePhotogallery($attribute, $value);
                break;
            
            default:
                # code...
                break;
        }
        return true;
    }

    private function validateImages($attribute, $values)
    {
        $result = $this->validateImage($attribute, $values);

        if($result == false)
        {
            $explodedAttribute = explode('.', $attribute);
            $this->index = $explodedAttribute[count($explodedAttribute) - 2] + 1;
            $this->attribute = $explodedAttribute[0];
            return $result;                
        }

        return true;
    } 

    private function validatePhotogallery($attribute, $values)
    {
        $result = $this->validateImage($attribute, $values);

        if($result == false)
        {
            $explodedAttribute = explode('.', $attribute);
            $this->index = $explodedAttribute[count($explodedAttribute) - 2] + 1;
            $this->attribute = $explodedAttribute[0];
            return $result;                
        }

        return true;
    }

    private function validateText($attribute, $value)
    {   
        switch ($this->ruleKey) {
            case 'min_length':
               return strlen($value) >= $this->ruleValue;
                break;

            case 'max_length':
               return strlen($value) <= $this->ruleValue;
                break;

            default:
                # code...
                break;
        }

        return false;
    }

    private function validateImage($attribute, $value)
    {
        try
        {
            $dimension = getImageSize($value);            
        }
        catch(\Exception $e)
        {
            $this->ruleKey = 'invalid';
            return false;
        }

        return true;

        // index 1 for height
        // index 0 for width
        // removing validation of height
        // switch ($this->ruleKey) {
        //     case 'height':
        //        return $dimension[1] == $this->ruleValue;
        //         break;

        //     case 'width':
        //        return $dimension[0] == $this->ruleValue;
        //         break;

        //     default:
        //         # code...
        //         break;
        // }
    }    

    private function validateVideo($attribute, $value)
    {
        $ffmpeg = FFMpeg\FFMpeg::create(
            [
                'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
                'timeout'          => 3600, // the timeout for the underlying process
                'ffmpeg.threads'   => 1,   // the number of threads that FFMpeg should use
            ]);
        $ffprobe = FFMpeg\FFProbe::create(
            [
                'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
                'timeout'          => 3600, // the timeout for the underlying process
                'ffmpeg.threads'   => 1,   // the number of threads that FFMpeg should use
            ]);

        if( ! $ffprobe->isValid($value))
        {
            $this->ruleKey = 'invalid';
            return false;
        }

        return true;
        // commenting validation of video for now
        // $dimension = $ffmpeg->open($value)
        //     ->getStreams()
        //     ->videos()
        //     ->first()
        //     ->getDimensions();    

        // // code gets duration of a video
        // $duration = $ffprobe
        //     ->format($value) // extracts file informations
        //     ->get('duration');             // returns the duration property

        // switch ($this->ruleKey) {
        //     case 'height':
        //        return $dimension->getHeight() == $this->ruleValue;
        //         break;

        //     case 'width':
        //        return $dimension->getWidth() == $this->ruleValue;
        //         break;

        //     case 'max_duration':
        //        return $duration <= $this->ruleValue;
        //         break;

        //     case 'min_duration':
        //        return $duration >= $this->ruleValue;
        //         break;

        //     default:
        //         # code...
        //         break;
        // }
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->type == 'images')
        {
            return str_replace(':attribute', $this->attribute, str_replace(':key', $this->index,str_replace(':ruleValue',  $this->ruleValue, $this->ruleBook[$this->type][$this->ruleKey])));
        }

        return str_replace(':ruleValue',  $this->ruleValue, $this->ruleBook[$this->type][$this->ruleKey]);
    }
}
