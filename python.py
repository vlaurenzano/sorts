
def bubble_sort_recursive(myList):
    '''This is a recursive bubble sort that takes a slightly different approach
        but it should still qualify as a bubble sort        
        O(n2)
    '''    
    for i in range(len(myList) - 1):
        if(myList[i] > myList[i+1]):
           myList[i], myList[i+1] =  myList[i+1], myList[i]
           return bubble_sort_recursive(myList)    
    return myList

def bubble_sort_iterative(myList):
    '''This is a standard bubble sort O(n2)'''    
    swapped = None
    while swapped == None or swapped > 0:        
        swapped = 0
        for i, v in enumerate(myList[:-1]):
            if(myList[i] > myList[i+1]):
                myList[i], myList[i+1] =  myList[i+1], myList[i]
                swapped = True
    return myList
    
def selection_sort(myList):
    '''O(n2)'''
    for i in range(len(myList) - 1):    
        minIndex = i
        for j in range(i + 1, len(myList)):    
            if(myList[j] < myList[minIndex]):
                minIndex = j
        else: # this else is not necessary, I don't know best practice yet in python
            if (minIndex != i):
                myList[i], myList[minIndex] =  myList[minIndex], myList[i]
            
    return myList

def insertion_sort(myList):
    '''Simple in place'''
    for i in range(1, len(myList)):            
        place = i
        for j in reversed(range(i)):            
            if (myList[j] > myList[i]):
                place = j                        
        if(place != i):            
            value = myList.pop(i)
            myList.insert(place, value)
    return myList       
            
def merge_sort(myList):
    '''average and worst n log n'''
    if(len(myList) < 2):
        return myList
    if(len(myList) == 2):
        if(myList[0] > myList[1]):
            return [myList[1], myList[0]]
        return myList    
    first = merge_sort(myList[0:int(len(myList)/2)])
    second = merge_sort(myList[int((len(myList)/2)):])            
    min = 0 #we'll keep track of min index here        
    while(type(second) is list and len(second) > 0): #used diff strat to merge here
        value = second.pop(0)                        
        inserted = False
        for i in range(min,len(first)):
            if(value < first[i]):
                first = first[:i] + [value] + first[i:]                
                min = i + 1        
                inserted = True
                break
        if(not inserted):
            first = first + [value] + second
            break
    return first
            
def quick_sort(myList):
    '''divide an conquer'''
    if(len(myList) < 2):
        return myList
    pivot = myList.pop(int(len(myList) / 2))
    left, right = [], [];
    for i in range(len(myList)):
        if(myList[i] <= pivot):
            left.append(myList[i])
        else: 
            right.append(myList[i])         
    return quick_sort(left) + [pivot] + quick_sort(right)
    
    
        
        
            
myList = [5, 10, 9, 3,6, 6,11, 1,2, 5]


print("Bubble sort recursive:", bubble_sort_recursive(myList[:]))
print("Bubble sort iterative:", bubble_sort_iterative(myList[:]))
print("Selection sort:       ", selection_sort(myList[:]))
print("Insertion Sort:       ", insertion_sort(myList[:]))
print("Merge Sort:           ", merge_sort(myList[:]))
print("Quick Sort:           ", quick_sort(myList[:]))

