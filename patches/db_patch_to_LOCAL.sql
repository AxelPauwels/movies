# PATCH: movies.sepagon.be -> movies.local

UPDATE `documentarySeizoen` SET imageUrl = REPLACE(imageUrl, 'https://movies.sepagon.be', 'http://movies.local');
UPDATE `episodesSeizoen` SET imageUrl = REPLACE(imageUrl, 'https://movies.sepagon.be', 'http://movies.local');
