# todo
Simple PHP ToDo App

- Think through problem
    - Minimum viable product features
        - Create
        - Update
        - Delete
    - Nice to have features
        - Ajax
        - Due dates
        - Reminders
        - Recurrence
- Pseudo code
    - Think like a user
        - how will you interact the list?
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
            - ToDo
            - done
            - CREATE TABLE IF NOT EXISTS `tb_todos` (
              `id` bigint(20) NOT NULL AUTO_INCREMENT,
              `todo` text NOT NULL,
              `done` tinyint(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    - PDO
