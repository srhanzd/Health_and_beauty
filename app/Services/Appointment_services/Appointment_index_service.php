<?php

namespace App\Services\Appointment_services;

use App\Http\Requests\AppointmentIndexRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Appointment_index_service
{
    use GeneralTrait;
    public function index(AppointmentIndexRequest $request)
    {
        $doctor_id=$request->validated()['doctor_id'];
        $service_id=$request->validated()['service_id'];

        try {

            $doctor_user = User::query()->where('IsDeleted', '=', 0)
               ->where('id', '=', $doctor_id)->first();
            $doctor_id=$doctor_user->doctor()->get('id')[0]['id'];
            $service=Service::query()->where('IsDeleted', '=', 0)
                ->where('id', '=', $service_id)->first();
            $service_step=$service['Step'];
            $datePeriod=CarbonPeriod::create(now(),now()->addMonth(1));
            $appointments=[];
            foreach ($datePeriod as $date) {
                $dayName = $date->format('l');
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
                            $appointmentServiceStep = $appointment->service()->get('step')[0]['step'];
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    $appointments[] = [
                        'day_name' => $dayName,
                        'date' => $date->format('d M'),
                        'full_date' => $date->format('Y-m-d'),
                        'all_appointments_times' => $hours,
                        'available_appointments_times' => $availableHours,
                        'appointments_reserved_times' => $currentAppointment
                    ];

                }
            }
            $appointments[]=[
                'full-period' => $datePeriod
            ];
            return $this->returnData('appointments',$appointments
            , 'Appointments available retrieved successfully.', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }
}
