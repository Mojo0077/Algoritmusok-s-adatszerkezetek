#!/bin/bash

# Mappák megadása
INPUT_DIR="inputs"
OUTPUT_DIR="outputs"

# Tesztesetek futtatása
for input_file in $INPUT_DIR/*.in; do
    # Tesztfájl neve
    base_name=$(basename "$input_file" .in)

    # Kimeneti fájl
    output_file="$OUTPUT_DIR/$base_name.out"

    # Előző eredmény (elvárt kimenetként használt)
    previous_output_file="$OUTPUT_DIR/$base_name.out"

    # PHP program futtatása
    php grid_paths_II.php "$input_file" "$output_file"

    # Eredmények ellenőrzése
    if diff -q "$output_file" "$previous_output_file" > /dev/null; then
        echo "$base_name: PASS"
    else
        echo "$base_name: FAIL"
        diff "$output_file" "$previous_output_file"
    fi
done
