<?php

namespace Programic\Rdw;

/**
 * @property string $registration_number
 * @property string $vehicle_type
 * @property string $brand
 * @property string $trade_name
 * @property string $expiry_date_mot
 * @property string $configuration
 * @property string $number_of_seats
 * @property string $first_color
 * @property string $second_color
 * @property string $number_of_cylinders
 * @property string $cylinder_capacity
 * @property string $mass_empty_vehicle
 * @property string $max_permitted_vehicle_mass
 * @property string $ready_to_drive_mass
 * @property string $max_unbraked_towing_mass
 * @property string $max_braked_towing_mass
 * @property string $date_first_admission
 * @property string $date_first_registration_nl
 * @property string $awaiting_inspection
 * @property string $list_price
 * @property string $wam_insured
 * @property string $number_of_doors
 * @property string $number_of_wheels
 * @property string $distance_coupling_to_rear
 * @property string $distance_front_to_coupling
 * @property string $length
 * @property string $width
 * @property string $european_vehicle_category
 * @property string $chassis_number_location
 * @property string $technical_max_vehicle_mass
 * @property string $type
 * @property string $type_approval_number
 * @property string $variant
 * @property string $execution
 * @property string $eu_type_approval_change_sequence
 * @property string $power_ready_to_drive
 * @property string $wheelbase
 * @property string $export_indicator
 * @property string $outstanding_recall_indicator
 * @property string $taxi_indicator
 * @property string $max_combination_weight
 * @property string $number_of_wheelchair_spaces
 * @property string $max_supportive_speed
 * @property string $year_last_reg_mileage
 * @property string $mileage_judgment
 * @property string $mileage_judgment_code
 * @property string $possible_registration_holder
 * @property string $expiry_date_mot_dt
 * @property string $date_first_admission_dt
 * @property string $date_first_registration_nl_dt
 * @property string $efficiency_classification
 * @property string $api_registered_vehicle_axes
 * @property string $api_registered_vehicle_fuel
 * @property string $api_registered_vehicle_body
 * @property string $api_registered_vehicle_body_specific
 * @property string $api_registered_vehicle_class
 * @property string $fuel_sequence_number
 * @property string $fuel_description
 * @property string $fuel_consumption_outside
 * @property string $fuel_consumption_combined
 * @property string $fuel_consumption_urban
 * @property string $co2_emissions_combined
 * @property string $idle_noise_level
 * @property string $emission_code_description
 * @property string $environmental_class_eu_light
 * @property string $light_particle_emissions
 * @property string $net_max_power
 * @property string $soot_emissions
 * @property string $noise_level_speed
 * @property string $exhaust_emission_level
 * @property string $eu_type_approval_key
 * @property string $eec_variant_code
 * @property string $eec_execution_code
 * @property string $execution_modification_number
 * @property string $sequence_number
 * @property string $gearbox_type
 * @property string $lower_gear_limits
 * @property string $upper_gear_limits
 */
class Result
{
    private array $data;

    public function __construct(readonly array $rawData)
    {
        $translation = require(__DIR__ . '/Translation/en.php');

        foreach($rawData as $key => $value) {
            if (isset($translation[$key])) {
                $this->data[$translation[$key]] = $value;
            }
        }
    }

    public function __get($get)
    {
        return data_get($this->data, $get);
    }
}


