To test the functionality and structure created by this MySQL script, you can perform several operations that demonstrate how data can be inserted, queried, updated, and deleted within the `Fjeltickets` database. This involves interacting with two main tables: `Brukere` (Users) and `Tickets`. Below are examples of how you can do this:

### 1. Inserting Data

First, you'll want to insert data into the `Brukere` and `Tickets` tables.

**Insert into `Brukere`:**
```sql
INSERT INTO `Fjeltickets`.`Brukere` (`Username`, `Pass`, `Perms`) VALUES ('user1', 'password123', 1);
```

**Insert into `Tickets`:**
Before inserting into `Tickets`, ensure there's a user ID to associate with. Assuming the user ID from the previous insert is 1:
```sql
INSERT INTO `Fjeltickets`.`Tickets` (`UserID`, `Title`, `Inhold`, `Status`) VALUES (1, 'Test Ticket', 'This is a test ticket.', 0);
```

### 2. Querying Data

To view the data you've inserted or to check other data, you can query these tables.

**Select from `Brukere`:**
```sql
SELECT * FROM `Fjeltickets`.`Brukere`;
```

**Select from `Tickets` with a join to show user info:**
```sql
SELECT Tickets.*, Brukere.Username FROM `Fjeltickets`.`Tickets` 
INNER JOIN `Fjeltickets`.`Brukere` ON Tickets.UserID = Brukere.idBrukere;
```

### 3. Updating Data

If you need to update data in either table, you can use the UPDATE statement.

**Update `Brukere`:**
```sql
UPDATE `Fjeltickets`.`Brukere` SET `Perms` = 2 WHERE `idBrukere` = 1;
```

**Update `Tickets`:**
```sql
UPDATE `Fjeltickets`.`Tickets` SET `Status` = 1 WHERE `TicketID` = 1;
```

### 4. Deleting Data

To remove data, use the DELETE statement. Be cautious with deletes, especially if your tables have foreign key relationships.

**Delete from `Tickets`:**
```sql
DELETE FROM `Fjeltickets`.`Tickets` WHERE `TicketID` = 1;
```

**Delete from `Brukere`:**
Note: You might need to delete all tickets associated with a user before deleting the user due to foreign key constraints.
```sql
DELETE FROM `Fjeltickets`.`Brukere` WHERE `idBrukere` = 1;
```

### Notes on Testing

- Before performing any operations, ensure your MySQL environment is set up and you have the necessary permissions.
- The deletion operations should be performed carefully to not violate foreign key constraints.
- Adjust the `INSERT` statements with real or more practical data for a more meaningful test.
- Consider using transactions if you're testing in a production environment or where data integrity is critical. Transactions allow you to roll back changes if something goes wrong.