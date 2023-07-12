<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppointmentReserveRequest extends FormRequest
{
    use GeneralTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'DoctorId'=> 'required',
            'ServiceId'=> 'required',
            'Notification_token'=> 'required',
            'Date'=>['required','date_format:Y-m-d'],
            'Time'=>['required','date_format:H:i'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }


    protected function prepareForValidation()
    {
        $this->is_Valid();


    }

    private function is_Valid(){

        $date=$this->date('Date');
        if (Carbon::parse($date)->isBefore(now()->startOfDay())) {
            if($this->header('lang')=='ar')
            abort(422, $this->translate('Invalid  date'));
            else
            abort(422, 'Invalid  date');

        }
        $dayName=$date->format('l');
        $doctor_user = User::query()
            ->where('IsDeleted', '=', 0)
            ->where('id', '=', $this->input('DoctorId'))
            ->first();
        $doctor_id=$doctor_user
            ->doctor()
            ->get('id')[0]['id'];
        $service=Service::query()
            ->where('IsDeleted', '=', 0)
            ->where('id', '=', $this->input('ServiceId'))
            ->first();
        $service_step=$service['Step'];
        $businessHours = $doctor_user->doctor_working_hours()
            ->where('Off', '=', 0)
            ->where('IsDeleted', '=', 0)
            ->whereHas('working_day', function ($query) use (&$dayName) {
                $query->where('Day', $dayName)
                    ->where('Off', '=', 0)
                    ->where('IsDeleted', '=', 0);
            })
            ->first();
        if ($businessHours) {
            $hours = $businessHours->getTimesPreiodAttribute($service_step);
            $hours = array_map(function ($time) use (&$date, & $dayName) {
                if (!$time->isPast() && $date->format('Y-m-d') == now()->format('Y-m-d')) {
                    return $time->format('H:i');
                }

                if ($date->format('Y-m-d') != now()->format('Y-m-d')) {
                    return $time->format('H:i');
                }
            }, $hours);
//
            $hours = array_filter($hours);
            $currentAppointment = Appointment::query()
                ->where('DoctorId', $doctor_id)
                ->where('Status','=', 0)
                ->where('Date', $date->toDateString())
                ->pluck('Time')
                ->flatMap(function ($time) use ($doctor_id, $date) {
                    $appointment = Appointment::query()
                        ->where('DoctorId', $doctor_id)
                        ->where('Status','=', 0)
                        ->where('Date', $date->toDateString())
                        ->where('Time', $time)->first();
                    $appointmentServiceStep = $appointment
                        ->service()
                        ->get('step')[0]['step'];
                    $timeBeforeAppointment = Carbon::parse($time)->subMinutes($appointmentServiceStep);

                    $timeAfterAppointment = Carbon::parse($time)->addMinutes($appointmentServiceStep);
                    return [
                        [
                            'before' => $timeBeforeAppointment->format('H:i'),
                            'start' => Carbon::parse($time)->format('H:i'),
                            'end' => $timeAfterAppointment->format('H:i')
                        ]
                    ];
                })
                ->toArray();

            $availableHours = array_filter($hours, function ($hour) use ($service_step, $currentAppointment) {
                $hourTimeStart = Carbon::parse($hour);
                $hourTimeEnd = Carbon::parse($hour)->addMinutes($service_step);
                foreach ($currentAppointment as $appointmentPeriod) {
                    $appointmentStartTime = Carbon::parse($appointmentPeriod['start']);
                    $appointmentEndTime = Carbon::parse($appointmentPeriod['end']);


                    if ($hourTimeStart <= $appointmentStartTime && $hourTimeEnd >= $appointmentEndTime) {
                        return false;
                    }


                }

                return true;
            });
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $currentAppointmentTimes = array_reduce($currentAppointment, function ($carry, $appointment) {
                $carry[] = $appointment['before'];
                $carry[] = $appointment['start'];
                $carry[] = $appointment['end'];
                return $carry;
            }, []);

            $availableHours = array_diff($availableHours, $currentAppointmentTimes);
            if(!in_array($this->input('Time'),$availableHours)) {
                if($this->header('lang')=='ar')
                    abort(422, $this->translate('Invalid  time'));
                else
                    abort(422,'Invalid  time');

            }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        $this->merge([
            'DoctorId' => $doctor_id,
            'PatientId' => auth()->user()->patient->id
        ]);

    }

}
