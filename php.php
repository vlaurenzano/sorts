<?php

$array = [5, 10, 9, 3,6, 6,11, 1,2, 5];

print_r(bubbleSort($array));
print_r(selectionSort($array));
print_r(insertionSort($array));
print_r(mergeSort($array));
print_r(quickSort($array));


/**
 * Sort an array and echo it   
 * Buble sort worst case & average O(n2)
 * Only nice thing is can tell if list is already sorted 
 * Not used in real world, insertion sort is better 
 * @param array $myArray
 */
function bubbleSort(array $myArray){    
    for($i = 0; $i < count($myArray) - 1; $i++){
        $next = $i + 1;
        if($myArray[$next] < $myArray[$i]){                        
            list($myArray[$i], $myArray[$next]) = [$myArray[$next], $myArray[$i]];            
            return bubbleSort($myArray);
        }
    }
    return $myArray;
}

/**
 * In place, O(n2)
 * Worse than insertion sort usually 
 * Simple
 * @param array $myArray
 */
function selectionSort(array $myArray){
    $sorted = [];
    while($myArray){
        $smallestKey = null;
        foreach($myArray as $key => $value){
            if($smallestKey === null) {
                $smallestKey = $key;
            } else if($myArray[$smallestKey] > $myArray[$key]) {
                $smallestKey = $key;
            }   
        }        
        $sorted[] = $myArray[$smallestKey];
        unset($myArray[$smallestKey]);
    }
    return $sorted;
}


/**
 * Simple
 * effiecient for small data sets, better than selection + bubble 
 * O(nk) when each input is no more than k places away
 * stable, in place and online
 * @param array $myArray
 */
function insertionSort(array $myArray){
    for($i = 1; $i < count($myArray); $i++){
        $previous = $i - 1;
        while($previous >= 0 && $myArray[$i] < $myArray[$previous]){            
            list($myArray[$i], $myArray[$previous]) = [$myArray[$previous], $myArray[$i]];    
            $i--;
            $previous--;
        } 
    }
    return $myArray;
}


/**
 * Stable, good for linked list
 * can be implemented parallel
 * @param array $myArray
 */
function mergeSort(array $myArray){
    if(count($myArray) < 2){
        return $myArray;
    } else if(count($myArray) === 2){
        if($myArray[0] > $myArray[1]){
            return [$myArray[1], $myArray[0]];
        }
        return $myArray;
    }
    $midPoint = ceil(count($myArray) / 2);
    $firstArray = mergeSort(array_slice($myArray, 0, $midPoint));
    $secondArray = mergeSort(array_slice($myArray, $midPoint, count($myArray)));
    $merged = [];
    while($firstArray && $secondArray){
        $firstVal  = array_shift($firstArray);
        $secondVal = array_shift($secondArray);
        $first   = $firstVal < $secondVal ? $firstVal : $secondVal;
        $second  = $firstVal < $secondVal ? $secondVal : $firstVal; 
        $last = end($merged);
        if($first < $last){
            list($merged[count($merged) - 1], $first) = [$first, $merged[count($merged) - 1]];
        }        
        $merged[] = $first;
        $merged[] = $second;
    }
    if($firstArray){
        $merged[] = array_shift($firstArray);
    }    
    return $merged;
}


/**
 * Commonly used, O(n log n) average, worst case O(n2) rare
 * Couldn't get this working in place when I tried, will have to return
 */
function quickSort(array $myArray){
    if(count($myArray) < 2){
        return $myArray;
    }        
    $p = ceil(count($myArray) / 2);//we'll put it in the middle
    $pivot = $myArray[$p];
    unset($myArray[$p]);    
    $lo = $hi = [];    
    foreach($myArray as $val){        
        if($val > $pivot){
            $hi[] = $val; 
        } else {
            $lo[] = $val;
        }
    }
    $first = quickSort($lo); 
    $last = quickSort($hi);     
    return array_merge($first, [$pivot], $last);
}
