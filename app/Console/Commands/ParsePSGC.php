<?php

namespace App\Console\Commands;

use App\Region;
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

    protected $latestRegion;

    protected $latestProvinceDistrict;

    protected $latestCity;

    protected $latestCityMunSubMun;

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
        $filePath = storage_path('excel/PSGC.csv');

        SimpleExcelReader::create($filePath)
            ->getRows()
            ->each(function (array $rowProperties) {
                $row = [
                    'code' => $rowProperties['Code'],
                    'name' => $rowProperties['Name'],
                    'level' => $rowProperties['Geographic Level'],
                    'city_class' => $rowProperties['City Class'],
                    'income_class' => $rowProperties["Income\nClassification"],
                    'area_type' => $rowProperties["Urban / Rural\n(based on 2015 POPCEN)"] == 'R' ? 'rural' : 'urban',
                    'population' => stringToInt($rowProperties["POPULATION\n(2015 POPCEN)"]),
                ];
                $methodName = 'create' . $row['level'];

                if (method_exists($this, $methodName)) {
                    $this->$methodName($row);
                }
            });
    }

    /**
     * Create a new region
     *
     * @param  array  $row
     */
    public function createReg($row)
    {
        $this->latestRegion = Region::create($row);
    }

    /**
     * Create a new province
     *
     * @param  array  $row
     */
    public function createProv($row)
    {
        $this->latestProvinceDistrict = $this->latestRegion->provinces()->create($row);
    }

    /**
     * Create a new district
     *
     * @param  array  $row
     */
    public function createDist($row)
    {
        $this->latestProvinceDistrict = $this->latestRegion->districts()->create($row);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createCity($row)
    {
        $specialCities = ['099701000', '129804000'];

        if (in_array($row['code'], $specialCities)) {
            $this->latestCityMunSubMun = $this->latestRegion->cities()->create($row);
        } else {
            $this->latestCityMunSubMun = $this->latestProvinceDistrict->cities()->create($row);
        }
        $this->latestCity = $this->latestCityMunSubMun;
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createMun($row)
    {
        $this->latestCityMunSubMun = $this->latestProvinceDistrict->municipalities()->create($row);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createSubMun($row)
    {
        $this->latestCityMunSubMun = $this->latestCity->subMunicipalities()->create($row);
    }

    /**
     * Create a new city
     *
     * @param  array  $row
     */
    public function createBgy($row)
    {
        $this->latestCityMunSubMun->barangays()->create($row);
    }
}
