<?php

use App\Models\Letter;
use App\Models\LetterSubmission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (!function_exists('df')) {
    function df($var)
    {
        header('Content-type: text/text');
        print_r($var);
        die;
    }
}

if (!function_exists('dm')) {
    function dm($var)
    {
        header('Content-type: text/text');
        print_r($var->toArray());
        die;
    }
}

if (!function_exists('dbl')) {
    function dbl()
    {
        DB::connection()->enableQueryLog();
    }
}

if (!function_exists('dbq')) {
    function dbq()
    {
        df(DB::getQueryLog());
    }
}

if (!function_exists('rupiah_format')) {
    function rupiah_format($number)
    {
        return number_format($number, 0, ',', '.');
    }
}

if (!function_exists('metaPagination')) {
    function metaPagination($paginator)
    {
        return [
            'pagination' => [
                'total'       => (int) $paginator->count(),
                'per_page'    => (int) $paginator->perPage(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'next_cursor' => $paginator->nextCursor()?->encode(),
            ],
        ];
    }
}

if (!function_exists('rand_char')) {
    function rand_char($digits = 5)
    {
        return substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, $digits);
    }
}

if (!function_exists('storeFile')) {
    function storeFile($path, $file, $resize = true, $width = 1600, $height = 1600)
    {
        if (!$file || !$path) {
            return false;
        }

        $temp = rand_char(16) . strtotime('now');

        Storage::disk('local')->put($temp, file_get_contents($file));
        $file = new File(storage_path('app/' . $temp));

        if (strpos($file->getMimeType(), 'image') !== false && $resize === true) {
            Image::make($file)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upSize();
            })->save($file->path());
        }

        $result = Storage::disk('public')->putFile($path, $file);
        Storage::disk('public')->setVisibility($result, 'public');
        Storage::disk('local')->delete($temp);

        return $result;
    }
}

if (!function_exists('setFileUrl')) {
    function setFileUrl($file)
    {
        try {
            if (!$file || !Storage::disk('public')->exists($file)) {
                return null;
            }

            return Storage::disk('public')->url($file);
        } catch (\Throwable $th) {
            return null;
        }
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($path)
    {
        return ($path && Storage::disk('local')->exists($path)) ? Storage::disk('local')->delete($path) : false;
    }
}

if (!function_exists('deleteDirectory')) {
    function deleteDirectory($path)
    {
        return ($path && Storage::disk('local')->exists($path)) ? Storage::disk('local')->deleteDirectory($path) : false;
    }
}

if (!function_exists('generateLetterNumber')) {
    function generateLetterNumber($letterTypeId) {
        $now   = Carbon::now();
        $month = $now->format('m');
        $year  = $now->format('Y');
        
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $montRoman = '';
        while ($month > 0) {
            foreach ($map as $roman => $int) {
                if($month >= $int) {
                    $month -= $int;
                    $montRoman .= $roman;
                    break;
                }
            }
        }

        $code = LetterSubmission::TYPES[$letterTypeId]['code'];
        $lastLetter = Letter::orderBy('id', 'DESC')->first();

        if (!$lastLetter) {
            $number = str_pad(config('settings.letter_number'), 3, '0', STR_PAD_LEFT);
        } else {
            $id     = $lastLetter->id + 1;
            $number = str_pad($id, 3, '0', STR_PAD_LEFT);
        } 

        return $code.'/'.$number.'/'.$montRoman.'/'.$year;
    }
}

if (!function_exists('convertAddress')) {
    function convertAddress($address) {
        if (in_array(strtoupper($address), User::ADDRESS)) {
            return ucwords(strtolower((string) $address.', '.config('settings.village').', '.config('settings.district').', '.config('settings.city').', '.config('settings.province')));
        }else {
            return $address;
        }
    }
}

if (!function_exists('isVillage')) {
    function isVillage($lastAddress) {
        $replace = ', '.config('settings.village').', '.config('settings.district').', '.config('settings.city').', '.config('settings.province');
        $address =  str_replace($replace, "" , strtoupper($lastAddress));
        if (in_array(strtoupper($address), User::ADDRESS)) {
            return [
                'value' => 1,
                'label' => $address,
            ];
        }else {
            return [
                'value' => 2,
                'label' => $lastAddress,
            ];
        }
    }
}