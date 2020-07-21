INSERT INTO clients (clientFirstname, clientLastname,
                     clientEmail, clientPassword, comments)

VALUES (
    'Tony',
    'Stark',
    'tony@starkent.com',
    'Iam1ronm@n',
    'I am the real Iron man'
    );

UPDATE clients
SET clientLevel = '3'
WHERE clientEmail = 'tony@starkent.com';

UPDATE inventory
SET invName = 'Climbing Rope',
    invDescription = replace(invDescription,
                            'nylon rope', 'climbing rope')
WHERE invId = 15;

SELECT i.invname, c.categoryName
FROM inventory i
    JOIN categories c
    ON i.categoryId = c.categoryId
WHERE c.categoryId = 3;

DELETE FROM inventory
WHERE invID = 7;