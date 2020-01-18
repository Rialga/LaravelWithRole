<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip','nama', 'email', 'password','role','pangkat',
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


    public function pangkat() {
        return $this->hasMany('App\pangkat', 'pangkat', 'id_pangkat');
    }

    private $have_role;

    public function role() {
        return $this->belongsTo('App\Jabatan', 'role', 'id_jabatan');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        if($this->have_role->nama_jabatan == ['Kepala SPKP','Anggota SPKP','Brigadir']) {
            return true;
        }
        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }
    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->nama_jabatan)) ? true : false;
    }
}
