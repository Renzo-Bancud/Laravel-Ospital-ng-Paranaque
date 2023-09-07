<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email', 'password','employee_id','picture','birth_date','age','gender','mobile','type','dept_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Scopes
    public function scopeEmployee($query)
    {
        return $query->whereType('admin')->whereType('doctor')->whereType('patient');
    }

    public function scopeAdmin($query)
    {
        return $query->whereType('admin');
    }

    public function scopeDoctor($query)
    {
        return $query->whereType(2);
    }

    public function scopePatient($query)
    {
        return $query->whereType(3);
    }

    public function scopeNurse($query)
    {
        return $query->whereType(4);
    }

    public function scopeAccountant($query)
    {
        return $query->whereType(5);
    }

    public function scopePharmacist($query)
    {
        return $query->whereType(6);
    }

    public function scopeLaboratorist($query)
    {
        return $query->whereType(7);
    }

    public function scopeReceptionist($query)
    {
        return $query->whereType(8);
    }


    // Relation Ships
    // Global Relations
    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public function timeSchedules(){
        return $this->hasMany(TimeSchedule::class);
    }

    public function dayoffSchedules(){
        return $this->hasMany(DayoffSchedule::class);
    }
 

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    // Short Cuts
    public function hasDepartment($departmentId){
        return in_array($departmentId,$this->departments->pluck('id')->toArray());
    }
}
