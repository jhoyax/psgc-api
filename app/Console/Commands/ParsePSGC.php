<?php

namespace App\Console\Commands;

use App\City;
use App\District;
use App\Municipality;
use App\Province;
use App\Region;
use App\SubMunicipality;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ParsePSGC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:psgc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse PSGC and load data to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = 'storage/excel/PSGC.csv';

        SimpleExcelReader::create($filePath)
            ->getRows()
            ->each(function (array $rowProperties) {
                $this->save($rowProperties);
            });
    }

    /**
     * Save data to database
     *
     * @param  array  $row
     */
    public function save($row)
    {
        switch ($row['Geographic Level']) {
            case 'Reg':
                $this->createRegion($row);
                break;
            case 'Prov':
                $this->createProvince($row);
                break;
            case 'Dist':
                $this->createDistrict($row);
                break;
            case 'City':
                $this->createCity($row);
                break;
            case 'Mun':
                $this->createMunicipality($row);
                break;
            case 'SubMun':
                $this->createSubMunicipality($row);
                break;
            case 'Bgy':
                $this->createBarangay($row);
                break;
        }
    }

    /**
     * Create a new region
     *
     * @param  array  $row
     */
    public function createRegion($row)
    {
        Region::create([
            'code' => $row['Code'],
            'name' => $row['Name'],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ]);
    }

    /**
     * Create a new province
     *
     * @param  array  $row
     */
    public function createProvince($row)
    {
        $lastRegion = Region::orderBy('created_at', 'desc')->first();

        $lastRegion->provinces()->create([
            'code' => $row['Code'],
            'name' => $row['Name'],
            'income_classification' => $row["Income\nClassification"],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ]);
    }

    /**
     * Create a new district
     *
     * @param  array  $row
     */
    public function createDistrict($row)
    {
        $lastRegion = Region::orderBy('created_at', 'desc')->first();

        $lastRegion->districts()->create([
            'code' => $row['Code'],
            'name' => $row['Name'],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ]);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createCity($row)
    {
        $lastProvince = Province::orderBy('created_at', 'desc')->first();
        $lastDistrict = District::orderBy('created_at', 'desc')->first();

        $latestProvince = optional($lastProvince)->id;
        $latestDistrict = optional($lastDistrict)->id;

        $data = [
            'code' => $row['Code'],
            'name' => $row['Name'],
            'city_class' => $row['City Class'],
            'income_classification' => $row["Income\nClassification"],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ];

        if ($latestProvince > $latestDistrict) {
            $lastProvince->cities()->create($data);
        } elseif ($latestDistrict > $latestProvince) {
            $lastDistrict->cities()->create($data);
        }
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createMunicipality($row)
    {
        $lastProvince = Province::orderBy('id', 'desc')->first();

        $lastProvince->municipalities()->create([
            'code' => $row['Code'],
            'name' => $row['Name'],
            'income_classification' => $row["Income\nClassification"],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ]);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createSubMunicipality($row)
    {
        $lastCity = City::orderBy('created_at', 'desc')->first();

        $lastCity->subMunicipalities()->create([
            'code' => $row['Code'],
            'name' => $row['Name'],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ]);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createBarangay($row)
    {
        $lastCity = City::orderBy('id', 'desc')->first();
        $lastMunicipality = Municipality::orderBy('id', 'desc')->first();
        $lastSubMunicipality = SubMunicipality::orderBy('id', 'desc')->first();

        $latestCity = optional($lastCity)->id;
        $latestMunicipality = optional($lastMunicipality)->id;
        $latestSubMunicipality = optional($lastSubMunicipality)->id;

        $data = [
            'code' => $row['Code'],
            'name' => $row['Name'],
            'population' => stringToInt($row["POPULATION\n(2015 POPCEN)"]),
        ];

        if (
            $latestCity > $latestMunicipality
            && $latestCity > $latestSubMunicipality
        ) {
            $lastCity->barangays()->create($data);
        } elseif (
            $latestMunicipality > $latestCity
            && $latestMunicipality > $latestSubMunicipality
        ) {
            $lastMunicipality->barangays()->create($data);
        } elseif (
            $latestSubMunicipality > $latestCity
            && $latestSubMunicipality > $latestMunicipality
        ) {
            $lastSubMunicipality->barangays()->create($data);
        }
    }
}
