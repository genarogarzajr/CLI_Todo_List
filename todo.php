<?php

// Create array to hold list of todo items
$items = array();

// List array items formatted for CLI
function list_items($list){

    foreach ($list as $key => $item) {

        // increases key from 0 to 1 to display in echo
        $key2 = $key +1;
        
        // Display each item and a newline
        echo "[{$key2}] {$item}\n";
    }

}

function sort_menu($list){
    echo  "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered" . PHP_EOL;
    
    $result = get_input(true);

    switch ($result) {
       case "A":
       asort($list);
       break;
       case 'Z':
       arsort($list);
       break;
       case 'O':
       ksort($list);
       break;   
       case 'R':
       krsort($list);
       break; 

   }  
   return $list;         
}

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = FALSE) 
{
    // Return filtered STDIN input
    $result = trim(fgets(STDIN));
    
    if ($upper) {
        return strtoupper($result);
    } else {
        return $result;
    }
}

// The loop!
do 
{
    // Iterate through list items
    echo list_items($items);
    // Show the menu options
    echo '(N)ew item, (R)emove item, (S)ort, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = get_input(true);

    // Check for actionable input
    if ($input == 'N') 
    {
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $NewItem = get_input(false);
        
        // ask how to enter new item
        echo "Add to (B)eginnng or (E)nd" . PHP_EOL;
            $BegOrEnd = get_input(true);
            if($BegOrEnd == 'B')
              {
                array_unshift($items, $NewItem);
              }
              elseif ($BegOrEnd == 'E')
              {
                array_push($items, $NewItem);
              }
        
    } elseif ($input == 'S') 
        {
            // Ask for entry
            $items = sort_menu($items);

        } elseif ($input == 'R') 
          {
            // Remove which item?
            echo 'Enter item number to remove: ';

            // Get array key
            $key = get_input(false);

            // decreases key before removing item
            $key2 = $key - 1;

            // Remove from array
            unset($items[$key2]);
          
          } elseif ($input == 'F')
    {
            array_shift($items);
    
    }       elseif ($input == 'L')

    {
            array_pop($items);
    }     
            
    
    // Exit when input is (Q)uit
} while ($input != 'Q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);