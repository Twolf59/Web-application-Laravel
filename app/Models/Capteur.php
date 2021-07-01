<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capteur extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'numero', 'gateway', 'installation_date', 'status', 'batterie', 'longitude', 'latitude', 'rssi'];

    /**
     * int
     */
    protected $id;

    /**
     * string
     */
    protected $numero;

    /**
     * string
     */
    protected $gateway;

    /**
     * date
     */
    protected $installation_date;

    /**
     * string
     */
    protected $status;

    /**
     * string
     */
    protected $batterie = NULL;

    /**
     * float
     */
    protected $latitude;

    /**
     * float
     */
    protected $longitude;

    /**
     * float
     */
    protected $rssi = NULL;

    /**
     * datetime
     */
    protected $created_at;

    /**
     * datetime
     */
    protected $updated_at;
}
