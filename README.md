# Booking Challenge

## Description

The task of the test is to correctly calculate room occupancy rates. 
Occupancy rates represent the number of occupied versus vacant rooms. We need occupancy rates for a single day vs multiple room ids and for a single month vs multiple room ids (so queries are not always against all rooms).

# Instalation

## Pre requisites

- Docker

## Install

    curl -s "https://raw.githubusercontent.com/raphaelcangucu/bookingchallenge/master/install" | bash

## Starting the project

    ./vendor/bin/sail up -d
    
## Run the migrations with seed

    ./vendor/bin/sail artisan migrate --seed

# Testing the project

## Api Documentation

You can access the main url at http://0.0.0.0  and try the Swagger routes

## Run command line tests

    ./vendor/bin/sail artisan test
# TODO

Tasks

- [x] OccupancyController, Repository
- [x] BookingController, Repository
- [x] Api Tests
- [x] Api Swagger Occupancy, Booking
- [x] README - Instalation