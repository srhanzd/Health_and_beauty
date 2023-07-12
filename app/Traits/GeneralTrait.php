<?php

namespace App\Traits;

use Stichoza\GoogleTranslate\Exceptions\LargeTextException;
use Stichoza\GoogleTranslate\Exceptions\RateLimitException;
use Stichoza\GoogleTranslate\Exceptions\TranslationRequestException;
use Stichoza\GoogleTranslate\GoogleTranslate;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }
    public function fire_base_push_notification($token,$title,$body)
    {
        $SERVER_API_KEY = config('notification-key');

        $token_1 = $token;

        $data = [

            "registration_ids" => [
                $token_1
            ],

            "notification" => [

                "title" => $title,

                "body" => $body,

                "sound"=> "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    }

    /**
     * @throws LargeTextException
     * @throws RateLimitException
     * @throws TranslationRequestException
     */
    public function returnError($errNum, $msg,$lang)
    {
        if($lang=='ar')
            $msg=$this->translate($msg);
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg,
//            'msg_ar' => $this->translate($msg),

        ]);
    }


    /**
     * @throws LargeTextException
     * @throws RateLimitException
     * @throws TranslationRequestException
     */
    public function returnSuccessMessage($msg = "", $errNum = "S000",$lang)
    {
        if($lang=='ar')
            $msg=$this->translate($msg);
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg,
          //  'msg_ar' => $this->translate($msg),

        ];
    }

    /**
     * @throws LargeTextException
     * @throws RateLimitException
     * @throws TranslationRequestException
     */
    public function returnData($key, $value, $msg = "",$lang)
    {
        if($lang=='ar')
            $msg=$this->translate($msg);
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => $msg,
//            'msg_ar' => $this->translate($msg),
            $key => $value
        ]);
    }


    //////////////////
    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    /**
     * @throws LargeTextException
     * @throws RateLimitException
     * @throws TranslationRequestException
     */
    private function translate($content)
    {
//            if($this->getLocale()=='ar') {
                // Import the GoogleTranslate class

                // Create an instance of GoogleTranslate
                $translator = new GoogleTranslate();

                // Set the source and target languages
                $translator->setSource('en'); // Set the source language to English
                $translator->setTarget('ar'); // Set the target language to Arabic

                // Translate the content
                return $translator->translate($content);
//            }
//            return null;
    }


    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0011';

        else if ($input == "password")
            return 'E002';

        else if ($input == "mobile")
            return 'E003';

        else if ($input == "id_number")
            return 'E004';

        else if ($input == "birth_date")
            return 'E005';

        else if ($input == "agreement")
            return 'E006';

        else if ($input == "email")
            return 'E007';

        else if ($input == "city_id")
            return 'E008';

        else if ($input == "insurance_company_id")
            return 'E009';

        else if ($input == "activation_code")
            return 'E010';

        else if ($input == "longitude")
            return 'E011';

        else if ($input == "latitude")
            return 'E012';

        else if ($input == "id")
            return 'E013';

        else if ($input == "promocode")
            return 'E014';

        else if ($input == "doctor_id")
            return 'E015';

        else if ($input == "payment_method" || $input == "payment_method_id")
            return 'E016';

        else if ($input == "day_date")
            return 'E017';

        else if ($input == "specification_id")
            return 'E018';

        else if ($input == "importance")
            return 'E019';

        else if ($input == "type")
            return 'E020';

        else if ($input == "message")
            return 'E021';

        else if ($input == "reservation_no")
            return 'E022';

        else if ($input == "reason")
            return 'E023';

        else if ($input == "branch_no")
            return 'E024';

        else if ($input == "name_en")
            return 'E025';

        else if ($input == "name_ar")
            return 'E026';

        else if ($input == "gender")
            return 'E027';

        else if ($input == "nickname_en")
            return 'E028';

        else if ($input == "nickname_ar")
            return 'E029';

        else if ($input == "rate")
            return 'E030';

        else if ($input == "price")
            return 'E031';

        else if ($input == "information_en")
            return 'E032';

        else if ($input == "information_ar")
            return 'E033';

        else if ($input == "street")
            return 'E034';

        else if ($input == "branch_id")
            return 'E035';

        else if ($input == "insurance_companies")
            return 'E036';

        else if ($input == "photo")
            return 'E037';

        else if ($input == "logo")
            return 'E038';

        else if ($input == "working_days")
            return 'E039';

        else if ($input == "insurance_companies")
            return 'E040';

        else if ($input == "reservation_period")
            return 'E041';

        else if ($input == "nationality_id")
            return 'E042';

        else if ($input == "commercial_no")
            return 'E043';

        else if ($input == "nickname_id")
            return 'E044';

        else if ($input == "reservation_id")
            return 'E045';

        else if ($input == "attachments")
            return 'E046';

        else if ($input == "summary")
            return 'E047';

        else if ($input == "user_id")
            return 'E048';

        else if ($input == "mobile_id")
            return 'E049';

        else if ($input == "paid")
            return 'E050';

        else if ($input == "use_insurance")
            return 'E051';

        else if ($input == "doctor_rate")
            return 'E052';

        else if ($input == "provider_rate")
            return 'E053';

        else if ($input == "message_id")
            return 'E054';

        else if ($input == "hide")
            return 'E055';

        else if ($input == "checkoutId")
            return 'E056';

        else
            return "";
        ///add all the filed you will use
    }


}
