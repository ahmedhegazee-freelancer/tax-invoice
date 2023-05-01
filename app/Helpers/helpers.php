<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Auth\Entities\User;

if (!function_exists('current_locale')) {
    function current_locale()
    {
        return App::getLocale() ?? "ar";
    }
}
if (!function_exists('get_gender')) {
    function get_gender(int $gender)
    {
        return $gender == 1 ? 'male' : 'female';
    }
}
if (!function_exists('set_gender')) {
    function set_gender(string $gender)
    {
        return $gender == 'male' ? 1 : 2;
    }
}
if (!function_exists('set_locale')) {
    function set_locale(string $locale)
    {
        if (!in_array($locale, config('app.supported_languages')))
            abort(400, __('messages.not_supported_language'));
        App::setLocale($locale);
    }
}
if (!function_exists('upload_image')) {
    function upload_image(UploadedFile $image, string $disk)
    {
        // return "storage/$disk/" . $image->store('', ['disk' => $disk]);
        return $image->store('', ['disk' => $disk]);
    }
}

if (!function_exists('delete_file')) {
    function delete_file(string $link)
    {
        if (file_exists($link) && !str_contains($link, 'default'))
            unlink($link);
    }
}

if (!function_exists('update_image')) {
    function update_image(array $config)
    {
        delete_file($config['oldLink']);
        return upload_image($config['icon'], $config['disk'], isset($config['uuid']) ? $config['uuid'] : null);
    }
}

if (!function_exists('success_add')) {
    function success_add(string $route)
    {
        return redirect_response('success', __('messages.added_successfully'), $route);
    }
}
if (!function_exists('success_update')) {
    function success_update(string $route)
    {
        return redirect_response('success', __('messages.success_update'), $route);
    }
}
if (!function_exists('success_delete')) {
    function success_delete(string $route)
    {
        return redirect_response('success', __('messages.success_delete'), $route);
    }
}

if (!function_exists('error_response')) {
    function error_response(string $message, string $route)
    {
        return redirect_response('danger', $message, $route);
    }
}

if (!function_exists('redirect_response')) {
    function redirect_response($type, $message, $route)
    {
        session()->flash($type, $message);
        session()->flash('type', $type);
        session()->flash('message', $message);
        return redirect()->back();
        // return redirect()->route($route)
        //     ->with('type', $type)->with('message', $message);
    }
}

if (!function_exists('is_available_subscription')) {
    function is_available_subscription()
    {
        return Session::get('is_subscription_available');
    }
}

if (!function_exists('arabic_date')) {
    function arabic_date($date, $addDay = false, $addYear = false)
    {

        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        $en_month = date("M", strtotime($date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }

        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date('D', strtotime($date)); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $current_date = "";
        if ($addDay) {
            $current_date .= $ar_day . ' ';
        }
        $current_date .=  date('d', strtotime($date)) . ' ' . $ar_month;
        if ($addYear) {
            $current_date .= ' ' . date('Y', strtotime($date));
        }
        $arabic_date = str_replace($standard, $eastern_arabic_symbols, $current_date);

        return $arabic_date;
    }
}
if (!function_exists('generate_coordination')) {
    function generate_coordination(float $min, float $max, int $places = 6)
    {
        $places = pow(10, $places);
        $min *= $places;
        $max *= $places;
        return rand($min, $max) / $places;
    }
}

if (!function_exists('generate_uuid')) {
    function generate_uuid(string $model)
    {
        $uuid = "";
        do {
            $uuid = Str::uuid();
        } while ($model::firstWhere("uuid", $uuid));
        return $uuid;
    }
}
if (!function_exists('get_contact_number')) {
    function get_contact_number(User $user)
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return "+9655111111111";
        }
        return $user->phone;
    }
}
if (!function_exists('get_owner_name')) {
    function get_owner_name(User $user)
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return "ادارة عقاراتكم";
        }
        return $user->name;
    }
}
if (!function_exists('get_whatsapp_number')) {
    function get_whatsapp_number(User $user)
    {
        if ($user->type == 'customer' || $user->type == 'admin') {
            return "+9655111111111";
        }
        if ($user->type == 'company')
            return $user->companyProfile()->select(['user_id', 'whatsapp_number'])->first()->whatsapp_number;

        return $user->marketerProfile()->select(['user_id', 'whatsapp_number'])->first()->whatsapp_number;
    }
}
if (!function_exists('generate_otp')) {
    function generate_otp()
    {
        // $code = 111111;
        $code = rand(111111, 999999);
        return $code;
    }
}
if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        return app()->basePath() . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR . $name .  $path;
    }
}
