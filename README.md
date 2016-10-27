#Basic Development Fundamentals
* Variables
    * Like basic algebra

```javascript
     x = 4
     x = x + 2
     print x
```

 * Arrays
    * A list of items
    * Numbered index

```javascript
    array_cars('ford', 'honda');
    print array_cars[1];
```

* Named indexes

```javascript
    array('first' => 'ford', 'second' => 'honda');
    print array['first'];
```

* Classes/Objects
    * The ultimate variable type
    * The basic structure is called a class, and implementation of that class is an object
    * Can contain its own variables called "properties"
    * Can contain functions called "methods"

```javascript
    object_car1->make = 'ford'
    object_car1->color = 'grey'
    object_car1->mileage = '35000'
    object_car1->state = 'dirty'
```        
* Lets say we have a method called "wash" that changes the car's state to 'clean'

```javascript
    object_car1->wash
    print object_car1
```
* Conditional
    * Logical operations

```javascript
    x > y
    x >= y
    x < y
    x <= y
    x != y
    x > y && a < b
    x < y || a > b
```    

```javascript
    if (x > 2) {
        print("Yay, x is greater than 2");
       } else {
        print ('Boo, x is 2 or less');
       }
```
* Loops
    * Repeat things for a number of times, or until some condition is met

```javascript
    while ( x < 10) {
        print ('X = ' . x);
        x = x + 1; // or x++;
    }
```

```javascript  
    do {
        print ('X = ' . x);
        x = x + 1; // or x++;
    } while (x < 10)
```

```javascript
    for (x = 0; x < 10; x++){
        print ('X = ' . x);
     }
```

* Functions
    * A sort of black box that ask to do something and it generally responds with an answer

```php
    function add ( $x, $y ) {
        return $x + $y;
    }      
    $x = add( 3, 4);
```

* Scope
    * You can have a variable within a function that shares a name with a variable outside of that function and there are zero issues with that.
    * Global scope
    * Function scope

#PHP Specifics
* Variables must start with a $
* Variable names are case sensitive: $x and $X are two different variables
* First character of a variable name (after the $) can't be a number.
* End of line signified by a ;

# ToDo
Simple PHP ToDo App

* Think through problem
    * Minimum viable product features
        * Create
        * Update
        * Delete
    * Nice to have features
        * Edit a ToDo's text
        * Due dates
        * Reminders
        * Recurrence
        * Ajax
* Pseudo code
    * Think like a user
        * How will you interact with the list?
        * What edge cases do you need to handle?
    * Write out workflow as comments
* Front End
    * Form elements
* Back End Code
    * Simple single page PHP form handling
    * Processing page handling
        * Separate presentation layer from processing
    * AJAX handling
* Back End Database
    * MySQL
        * Fields
            * id
            * todo
            * done

```SQL
    CREATE TABLE IF NOT EXISTS `tb_todos` (
      `id` bigint(20) NOT NULL AUTO_INCREMENT,
      `todo` text NOT NULL,
      `done` tinyint(1) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
```

# SQL Basics
If you want a good place to learn the basics of SQL try this SQLZoo playground. It lets you run various queries against their sample tables.
http://sqlzoo.net/

# Database and PDO
PDO (PHP Data Objects) is currently the best way to interact with a database within PHP.
It provides some simple classes that make connecting to and getting data into and out of a database easier, and also simplifies interacting with different types of databases (MySQL, MS SQL, Oracle, PostgreSQL).

* db-config.php

```php
    <?php
    //keep this database info in a single file so that you only have to change it once to update your whole project
    $db_info['server'] = 'localhost';
    $db_info['name'] = '';
    $db_info['user'] = '';
    $db_info['pass'] = '';
```

* Setting up a connection to a database and setting the error mode to aid in debugging

```php
//pull in our db_config file
require_once('db_config.php'); //or whatever the path to your file is, this assumes it's a file in our current directory
//create a connection to our database using a "connection string" which tells PDO the type of database and other info it needs to communicate with it
$db = new PDO('mysql:host=' . $db_info['server'] . ';dbname=' . $db_info['name'] . '', $db_info['user'], $db_info['pass']);
//sets the attribute "Error Mode" to "Exceptions" so that our code is easier to debug
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

* Selecting some data from a table
  * Select if only expecting a single result

```php
//prepare our SQL statement with parameters for the variables we need to pass in
$stmt = $db->prepare( "SELECT field1, field2 FROM MYTABLE WHERE field3 = :field3 AND field4 = :field4" );
//tells our $stmt object that this parameter "field3" = the value of this PHP variable "$field3" and it should treat it like a string
$stmt->bindParam(':field3', $field3, PDO::PARAM_STR);
//same as above but this parameter should be treated as an integer
$stmt->bindParam(':field4', $field4, PDO::PARAM_INT);
//run our fully prepared query
$stmt->execute();
//assign the results of our query to a variable that we can work with in our code
//PDO::FETCH_OBJ returns a single result as an object as opposed to PDO::FETCH_ASSOC which would return the result as an array
$result = $stmt->fetch(PDO::FETCH_OBJ);  

//with PDO::FETCH_OBJ
print( 'Field 1: ' . $result->field1 . '<br />');
print( 'Field 2: ' . $result->field2 . '<br />');
print('<br />');

with PDO::FETCH_ASSOC
print( 'Field 1: ' . $result['field1'] . '<br />');
print( 'Field 2: ' . $result['field2'] . '<br />');
print('<br />');
```

  * Select if expecting more than one result

```php
$stmt = $db->prepare( "SELECT field1, field2 FROM MYTABLE WHERE field3 = :field3" );
$stmt->bindParam(':field3', $field3, PDO::PARAM_STR);
$stmt->execute();
//return a collection of result objects or result arrays if using PDO::FETCH_ASSOC
$results = $stmt->fetchAll(PDO::FETCH_OBJ);  

//step over our results with a foreach loop
foreach ( $results as $result ) {
  print( 'Field 1: ' . $result->field1 . '<br />');
  print( 'Field 2: ' . $result->field2 . '<br />');
  print('<br />');
}
```

* Insert data into a table

```php
$stmt = $db->prepare( "INSERT INTO MYTABLE(field1, field2) VALUES(:field1, :field2)" );
$stmt->bindParam(':field1', $field1, PDO::PARAM_STR);
$stmt->bindParam(':field2', $field2, PDO::PARAM_INT);
$stmt->execute();
```

* Edit data in a table

```php
$stmt = $db->prepare( "UPDATE MYTABLE SET field1 = :new_field1 WHERE field2 = :field2" );
$stmt->bindParam(':new_field1', $field1, PDO::PARAM_STR);
$stmt->bindParam(':field2', $field2, PDO::PARAM_INT);
$stmt->execute();
```

* Delete data into from table

```php
$stmt = $db->prepare( "DELETE FROM MYTABLE WHERE field1 = :field1" );
$stmt->bindParam(':field1', $field1, PDO::PARAM_INT);
$stmt->execute();
```
