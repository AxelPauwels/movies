-- MOVIES --

-- Scramble users data
DROP FUNCTION IF EXISTS GENERATE_NAME;
DELIMITER //
CREATE FUNCTION GENERATE_NAME () RETURNS varchar(255)
BEGIN
    RETURN ELT(FLOOR(1 + (RAND() * 10)), "Tom", "Frank", "Mieke", "Steven", "Admin", "Info", "Annemie", "Kevin", "Daisy", "Hans", "Stef");
END//
DELIMITER ;

-- Obfuscate data
UPDATE users SET naam=GENERATE_NAME() WHERE naam IS NOT NULL;
UPDATE users SET email=CONCAT(SUBSTRING(MD5(RAND()) FROM 1 FOR 8), '@example.com') WHERE email IS NOT NULL;
UPDATE users SET password=CONCAT(UUID()) WHERE password IS NOT NULL;
UPDATE users SET creatie=CURDATE() WHERE creatie IS NOT NULL;

-- Remove functions
DROP FUNCTION IF EXISTS GENERATE_NAME;

-- Insert test user
INSERT INTO users (id, naam, email, password, level, creatie, laatstAangemeld, geactiveerd, gedownload) VALUES (200, 'root', 'root@movieserver.com', '2fe6c530992716556c918bcd4a6995e2b5cc6914', 1, CURDATE(), CURDATE(), 1, 6719)
