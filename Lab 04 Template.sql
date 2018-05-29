SQL> /*** Step 1 Run script to create table ***/
SQL> create table MYTEXTBOOK 
(text_id number(5),
text_name varchar2(25),
text_author varchar2(50),
text_publisher varchar2(25),
faculty_ref number(5));

Table MYTEXTBOOK created.

SQL> /*** Step 2 Insert data ***/
SQL> insert into MYTEXTBOOK
(text_name, text_author, text_publisher, faculty_ref) 
values ('All computers', 'Know It All', 'Self', 3);

1 row inserted.

SQL> INSERT into MYTEXTBOOK
(text_name, text_author, text_publisher, faculty_ref)
values ('No homework!', 'Tired Student', 'Publish', 1);

1 row inserted.

SQL> /*** Step 3 Create sequence ***/
SQL> create sequence textbook_seq
start with 22
nocache
nocycle;

Sequence TEXTBOOK_SEQ created.

SQL> /*** Step 4 Update with sequence ***/
SQL> select * from mytextbook;

   TEXT_ID TEXT_NAME
---------- -------------------------
TEXT_AUTHOR                                        TEXT_PUBLISHER
-------------------------------------------------- -------------------------
FACULTY_REF
-----------
           All computers             
Know It All                                        Self                      
          3

           No homework!              
Tired Student                                      Publish                   
          1


SQL> update MYTEXTBOOK
set text_id = textbook_seq.nextval
where text_name = 'All computers';

1 row updated.

SQL> update MYTEXTBOOK
set text_id = textbook_seq.nextval
where text_name = 'No homework!';

1 row updated.

SQL> /*** Step 5 Display details about textbook_seq ***/
SQL> select sequence_name, max_value, increment_by, last_number
from user_sequences
where sequence_name = 'TEXTBOOK_SEQ';

SEQUENCE_NAME                   MAX_VALUE
------------------------------ ----------
                           INCREMENT_BY                             LAST_NUMBER
--------------------------------------- ---------------------------------------
TEXTBOOK_SEQ                      1.0E+28 
                                      1                                      24


SQL> /*** Step 6 Make text_id the primary key ***/
SQL> alter table MYTEXTBOOK
add constraint my_text_book_pk
primary key (text_id);

Table MYTEXTBOOK altered.

SQL> /*** Step 7 Insert values ***/
SQL> insert into MYTEXTBOOK
(text_id, text_name, text_author, text_publisher, faculty_ref) 
values (textbook_seq.nextval, 'Relational Databases', 'Ted Codd', 'IT', 2);

1 row inserted.

SQL> insert into MYTEXTBOOK
(text_id, text_name, text_author, text_publisher, faculty_ref) 
values (textbook_seq.nextval, 'The greatest book ever', 'Forest Vey', 'Publish', 1);

1 row inserted.

SQL> /*** Step 8 List from MYTEXTBOOK ***/
SQL> select text_id, text_author
from MYTEXTBOOK;

   TEXT_ID TEXT_AUTHOR                                      
---------- --------------------------------------------------
        22 Know It All                                       
        23 Tired Student                                     
        24 Ted Codd                                          
        25 Forest Vey                                        

SQL> /*** Step 9 Create non-unique index ***/
SQL> create index textname_idx
on MYTEXTBOOK(text_name);

Index TEXTNAME_IDX created.

SQL> /*** Step 10 Display details about indexes on textbook table ***/
SQL> select index_name, index_type, uniqueness
from user_indexes
where table_name = 'MYTEXTBOOK';

INDEX_NAME                     INDEX_TYPE                  UNIQUENES
------------------------------ --------------------------- ---------
MY_TEXT_BOOK_PK                NORMAL                      UNIQUE   
TEXTNAME_IDX                   NORMAL                      NONUNIQUE

SQL> /*** Step 11 Create synonym ***/
SQL> create synonym TEXT for MYTEXTBOOK;

Synonym TEXT created.

SQL> /*** Step 12 Use synonym to list ***/
SQL> select text_id, text_author
from text;

   TEXT_ID TEXT_AUTHOR                                      
---------- --------------------------------------------------
        22 Know It All                                       
        23 Tired Student                                     
        24 Ted Codd                                          
        25 Forest Vey                                        

SQL> /*** Step 13 Display synonym names ***/
SQL> select synonym_name
from user_synonyms;

SYNONYM_NAME
------------
TEXT        
Student Grad
es Listings


SQL> /*** Step 14 Drop schema objects ***/
SQL> drop table MYTEXTBOOK purge;

Table MYTEXTBOOK dropped.

SQL> drop sequence textbook_seq;

Sequence TEXTBOOK_SEQ dropped.

SQL> drop synonym TEXT;

Synonym TEXT dropped.