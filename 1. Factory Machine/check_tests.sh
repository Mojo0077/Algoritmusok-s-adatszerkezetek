#!/bin/bash

# Mappák megadása
INPUT_DIR="inputs"
OUTPUT_DIR="outputs"
EXPECTED_DIR="outputs"

# Tesztesetek futtatása
for input_file in $INPUT_DIR/*.in; do
    # Tesztfájl neve
    base_name=$(basename "$input_file" .in)
    
    # Kimeneti fájl
    output_file="$OUTPUT_DIR/$base_name.out"
    
    # Elvárt kimenet
    expected_file="$EXPECTED_DIR/$base_name.out"
    
    # PHP program futtatása
    php factory_machines_solution.php "$input_file" "$output_file"
    
    # Eredmények ellenőrzése
    if diff -q "$output_file" "$expected_file" > /dev/null; then
        echo "$base_name: PASS"
    else
        echo "$base_name: FAIL"
        diff "$output_file" "$expected_file"
    fi
done
