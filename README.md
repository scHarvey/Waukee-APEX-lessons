#Basic Development Fundamentals
- Variables
    - Like basic algebra 
     ```javascript
     x = 4 
     x + 4 = 8
     ```
    - Arrays
        - A list of items 
        - Numbered index 
             ```javascript
             array_cars('ford', 'honda');
             echo array[1];
             ```
        - Named indexes 
            ```javascript
             array('first' => 'ford', 'second' => 'honda');
             echo array['first'];
            ```
    - Classes/Objects
        - The ultimate variable type
        - The basic structure is called a class, and implementation of that class is an object
        - Can contain its own variables called "properties"
        - Can contain functions called "methods"
            ```javascript
            object_car1->make = 'ford'
            object_car1->color = 'grey'
            object_car1->milage = '35000'
            object_car1->state = 'dirty'
            ```        
        - Lets say we have a method called "wash" that changes the car's state to 'clean'
            ```javascript
            object_car1->wash
            echo object_car1
            ```
- Conditional
    - Logical operations
        ```php
        if (x > 2) { 
            print("Yay, x is greater than 2"); 
           } else { 
            print ('Boo, x is 2 or less'); 
           }
         ```
- Loops
    - Repeat things for a number of times, or until some condition is met
        ```php
        while ( x < 10) { 
            print ('X = ' . x);
            x = x + 1; // or x++;
        }
        ```
        ```php  
        do {
            print ('X = ' . x);
        } while (x < 10)
        ```
        ```php
        for (x = 0; x < 10; x++){
            print ('X = ' . x);
        }
        ```
- Functions
    - A sort of black box that ask to do something and it generally responds with an answer
        ```php
        function add ( $x, $y ) {
            return $x + $y;
        }      
        $x = sum( 3, 4);
        ```
- Scope
    - You can have a variable within a function that shares a name with a variable outside of that function and there are zero issues with that.
    - Global scope
    - Function scope

#PHP Specifics
    - Variables must start with a $
    - Variable names are case sensitive: $x and $X are two different variables
    - First character of a variable name (after the $) can't be a number.
    - End of line signified by a ;

# todo
Simple PHP ToDo App

- Think through problem
    - Minimum viable product features
        - Create
        - Update
        - Delete
    - Nice to have features
        - Edit a ToDo's text
        - Due dates
        - Reminders
        - Recurrence
        - Ajax
- Pseudo code
    - Think like a user
        - How will you interact with the list?
        - What edge cases do you need to handle?
    - Write out workflow as comments
- Front End
    - Form elements
- Back End Code
    - Simple single page PHP form handling
    - Processing page handling
        - Separate presentation layer from processing
    - AJAX handling
- Back End Database
    - - Back End Database
    - MySQL
        - Fields
            - id
            - todo
            - done
            ```SQL
            CREATE TABLE IF NOT EXISTS `tb_todos` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `todo` text NOT NULL,
              `done` tinyint(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    - PDO
    - db-config.php
        ```php
        <?php
        //database info
        $db_info['server'] = 'localhost';
        $db_info['name'] = '';
        $db_info['user'] = '';
        $db_info['pass'] = '';
        ```
