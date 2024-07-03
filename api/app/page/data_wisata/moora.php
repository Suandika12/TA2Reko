<?php

interface DMoora {
    public function get();
}

class Moora
{
    private $data;
    private $weights;
    private $maximize;

    public function __construct($data, $weights, $maximize = true)
    {
        $this->data = $data;
        $this->weights = $weights;
        $this->maximize = $maximize;
    }

    function moora()
    {
        $maximize = $this->maximize;
        $data = $this->data->get();
        $weights = $this->weights->get();

        // Normalize the data
        $normalized_data = array_map(function ($row) {
            $norm = sqrt(array_sum(array_map(function ($val) {
                return pow($val, 2);
            }, $row)));
            return array_map(function ($val) use ($norm) {
                return $val / $norm;
            }, $row);
        }, $data);

        // Normalize weights
        $total_weight = array_sum($weights);
        $normalized_weights = array_map(function ($weight) use ($total_weight) {
            return $weight / $total_weight;
        }, $weights);

        // Determine if we need to maximize or minimize each criterion
        $direction = $maximize ? 1 : -1;

        // Calculate the weighted normalized data
        $weighted_normalized_data = array_map(function ($row) use ($normalized_weights) {
            return array_map(function ($val, $weight) {
                return $val * $weight;
            }, $row, $normalized_weights);
        }, $normalized_data);

        // Calculate the ideal best and ideal worst alternatives
        $ideal_best = array_map(function ($col) use ($direction) {
            return max($col) * $direction;
        }, array_map(null, ...$weighted_normalized_data));

        $ideal_worst = array_map(function ($col) use ($direction) {
            return min($col) * $direction;
        }, array_map(null, ...$weighted_normalized_data));

        // Calculate the distance of each alternative from the ideal best and ideal worst
        $distance_from_best = array_map(function ($row) use ($ideal_best) {
            return sqrt(array_sum(array_map(function ($val, $best) {
                return pow($val - $best, 2);
            }, $row, $ideal_best)));
        }, $weighted_normalized_data);

        $distance_from_worst = array_map(function ($row) use ($ideal_worst) {
            return sqrt(array_sum(array_map(function ($val, $worst) {
                return pow($val - $worst, 2);
            }, $row, $ideal_worst)));
        }, $weighted_normalized_data);

        // Calculate the MOORA score for each alternative
        $scores = array_map(function ($dist_best, $dist_worst) {
            return $dist_worst / ($dist_best + $dist_worst);
        }, $distance_from_best, $distance_from_worst);
        return $scores;
    }
}

